<?php

namespace App\Actions\Pillars\PSM;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\PSM\PSMReport;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PSMAction
{
    use Validation;
    use HandleAttachment;

    public function __construct(
        protected ?Request $request = null,
        protected $attachmentPath = 'pillars/psm',
        protected $photoDimension = 500,
    ) {
    }

    public function getQuery()
    {
        $query = PSM::query();
        if (! auth()->user()?->isDinsosJatim) {
            $query->where('office_id', auth()->user()->office->id);
        }
        $query->latest();

        return $query;
    }

    public function create(): bool
    {
        $this->request->merge([
            'membership_number' => str_replace(array('-', '.'), '', $this->request->input('membership_number')),
        ]);
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $psm = new PSM();
        $psm->fill($filteredRequest);
        $psm->office_id = (auth()->user()->isDinsosJatim ? $this->request->input('office_id') : auth()->user()->office->id);

        if ($this->request->hasFile('attachments.*') ?? false) {
            $attachments = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->photoDimension, $this->attachmentPath),
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->photoDimension, $this->attachmentPath)
            ];
            $psm->attachments = $attachments;
        }

        if ($this->request->hasFile('technical_guidance.*') ?? false) {
            $technicalGuidance = [
                'certificate_number' => $this->request->input('technical_guidance.certificate_number'),
                'organizer' => $this->request->input('technical_guidance.organizer'),
                'certificate_date' => $this->request->input('technical_guidance.certificate_date'),
                'certificate_path' => $this->storeDocument($this->request->file('technical_guidance.certificate_path'), $this->attachmentPath)
            ];
            $psm->technical_guidance = $technicalGuidance;
        }

        return $psm->save();
    }

    public function update(PSM $psm): bool
    {
        $this->request->merge([
            'membership_number' => str_replace(array('-', '.'), '', $this->request->input('membership_number')),
        ]);
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($psm)));

        $psm->fill($filteredRequest->except(['attachments', 'technical_guidance'])->toArray());
        $psm->office_id = (auth()->user()->isDinsosJatim ? $this->request->input('office_id') : auth()->user()->office->id);

        if ($this->request->hasFile('attachments.photo')) {
            $this->deleteAttachment($psm->attachments['photo']);
            $attachment = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->photoDimension, $this->attachmentPath),
                'ktp' => $psm->attachments['ktp'] ?? '',
            ];

            $psm->attachments = $attachment;
        } else if ($this->request->hasFile('attachments.ktp')) {
            $this->deleteAttachment($psm->attachments['ktp']);
            $attachment = [
                'photo' => $psm->attachments['photo'] ?? '',
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->photoDimension, $this->attachmentPath)
            ];

            $psm->attachments = $attachment;
        }

        if ($this->request->hasFile('attachments.photo') && $this->request->hasFile('attachments.ktp') ?? false) {
            $this->deleteAttachment($psm->attachments['photo']);
            $this->deleteAttachment($psm->attachments['ktp']);

            $attachments = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->photoDimension, $this->attachmentPath),
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->photoDimension, $this->attachmentPath),
            ];
            $psm->attachments = $attachments;
        }

        if ($this->request->hasFile('technical_guidance.certificate_path')) {
            $this->deleteAttachment($psm->technical_guidance['certificate_path']);
            $technicalGuidance = [
                'certificate_number' => $this->request->input('technical_guidance.certificate_number'),
                'organizer' => $this->request->input('technical_guidance.organizer'),
                'certificate_date' => $this->request->input('technical_guidance.certificate_date'),
                'certificate_path' => $this->storeDocument($this->request->file('technical_guidance.certificate_path'), $this->attachmentPath)
            ];
            $psm->technical_guidance = $technicalGuidance;
        } else {
            $technicalGuidance = [
                'certificate_number' => $this->request->input('technical_guidance.certificate_number'),
                'organizer' => $this->request->input('technical_guidance.organizer'),
                'certificate_date' => $this->request->input('technical_guidance.certificate_date'),
                'certificate_path' => $psm->technical_guidance['certificate_path'] ?? ''
            ];
            $psm->technical_guidance = $technicalGuidance;
        }

        return $psm->save();
    }

    public function delete(PSM $psm)
    {
        if ($psm->attachments ?? false) {
            $this->deleteAttachment($psm->attachments['photo']);
            $this->deleteAttachment($psm->attachments['ktp']);
        }

        if ($psm->technical_guidance ?? false) {
            $this->deleteAttachment($psm->technical_guidance['certificate_path']);
        }

        return $psm->user()->delete();
    }

    public function getReports(PSM $psm, string $type): Collection
    {
        return match ($type) {
            PSMReport::TYPE_DAILY => $psm->reports()->where('type', 'daily')->get(),
            PSMReport::TYPE_MONTHLY => $psm->reports()->where('type', 'monthly')->get(),
        };
    }


    private function rules(?PSM $psm = null): array
    {
        return [
            'office_id' => (auth()->user()->isDinsosJatim ? 'required|' : 'nullable|') . 'numeric|exists:offices,id',
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|min:16|max:16|unique:psms,nik,' . $psm?->id,
            'membership_number' => 'required|string|min:10|max:10|unique:psms,membership_number,' . $psm?->id,
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'religion' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'last_education' => 'required|string|max:255',
            'year_of_appointment' => 'required|max:4',
            'main_job' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'technical_guidance' => 'required|array',
            'technical_guidance.*' => 'required',
            'address' => 'required|array',
            'address.*' => 'required',
            'duty_address' => 'nullable|array',
            'duty_address.*' => 'required',
            'attachments' => 'array|' . ($psm ? 'nullable' : 'required'),
            'attachments.*' => 'image|mimes:jpeg,png,jpg|max:2048| ' . ($psm ? 'nullable' : 'required'),
        ];
    }
}
