<?php

namespace App\Actions\Pillars\TKSK;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class TKSKAction
 * Author: Chrisdion Andrew
 * Date: 6/10/2023
 */

class TKSKAction
{
    use Validation;
    use HandleAttachment;

    protected Request $request;
    protected ?TKSK $tksk;
    protected string $attachmentPath;
    protected string $dimension;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->attachmentPath = 'pillars/tksk';
        $this->dimension = 500;
    }

    public function getQuery()
    {
        $query = TKSK::query();

        if (! auth()->user()?->isDinsosJatim) {
            $query->where('office_id', auth()->user()->office->id);
        }

        $query->latest();

        return $query;
    }

    public function getReports(TKSK $tksk, string $type): Collection
    {
        return match ($type) {
            TKSKReport::TYPE_DAILY => $tksk->reports()->where('type', 'daily')->get(),
            TKSKReport::TYPE_MONTHLY => $tksk->reports()->where('type', 'monthly')->get(),
        };
    }

    public function create(): bool
    {
        $this->request->merge([
            'membership_number' => str_replace(array('-', '.'), '', $this->request->input('membership_number')),
        ]);
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $this->tksk = new TKSK();
        $this->tksk->fill($filteredRequest);
        $this->tksk->office_id = (auth()->user()->isDinsosJatim ? $this->request->input('office_id') : auth()->user()->office->id);

        if ($this->request->hasFile('attachments.*') ?? false) {
            $attachments = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->dimension, $this->attachmentPath),
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->dimension, $this->attachmentPath),
            ];
            $this->tksk->attachments = $attachments;
        }

        return $this->tksk->save();
    }

    public function update(TKSK $tksk): bool
    {
        $this->request->merge([
            'membership_number' => str_replace(array('-', '.'), '', $this->request->input('membership_number')),
        ]);
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($tksk)));

        $this->tksk = $tksk;
        $this->tksk->fill($filteredRequest->except(['attachments'])->toArray());
        $this->tksk->office_id = (auth()->user()->isDinsosJatim ? $this->request->input('office_id') : auth()->user()->office->id);

        if ($this->request->hasFile('attachments.photo')) {
            $this->deleteAttachment($this->tksk->attachments['photo']);
            $attachment = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->dimension, $this->attachmentPath),
                'ktp' => $this->tksk->attachments['ktp'] ?? '',
            ];

            $this->tksk->attachments = $attachment;
        } else if ($this->request->hasFile('attachments.ktp')) {
            $this->deleteAttachment($this->tksk->attachments['ktp']);
            $attachment = [
                'photo' => $this->tksk->attachments['photo'] ?? '',
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->dimension, $this->attachmentPath)
            ];

            $this->tksk->attachments = $attachment;
        }

        if ($this->request->hasFile('attachments.photo') && $this->request->hasFile('attachments.ktp') ?? false) {
            $this->deleteAttachment($this->tksk->attachments['photo']);
            $this->deleteAttachment($this->tksk->attachments['ktp']);

            $attachments = [
                'photo' => $this->storePhoto($this->request->file('attachments.photo'), $this->dimension, $this->attachmentPath),
                'ktp' => $this->storePhoto($this->request->file('attachments.ktp'), $this->dimension, $this->attachmentPath),
            ];
            $this->tksk->attachments = $attachments;
        }

        return $this->tksk->save();
    }

    public function delete(TKSK $tksk)
    {
        $this->tksk = $tksk;

        if ($this->tksk->attachments ?? false) {
            $this->deleteAttachment($this->tksk->attachments['photo']);
            $this->deleteAttachment($this->tksk->attachments['ktp']);
        }

        return $this->tksk->user()->delete();
    }


    private function rules(?TKSK $tksk = null): array
    {
        return [
            'office_id' => (auth()->user()->isDinsosJatim ? 'required|' : 'nullable|') . 'numeric|exists:offices,id',
            'name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'nik' => 'required|string|min:16|max:16|unique:tksks,nik,' . $tksk?->id,
            'membership_number' => 'required|string|min:10|max:10|unique:tksks,membership_number,' . $tksk?->id,
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
            'annual_evaluation_grade' => 'nullable|string',
            'address' => 'required|array',
            'address.*' => 'required',
            'duty_address' => 'nullable|array',
            'duty_address.*' => 'required',
            'bank_accounts' => 'nullable|array',
            'bank_accounts.*' => 'nullable|numeric',
            'attachments' => 'array|' . ($tksk ? 'nullable' : 'required'),
            'attachments.*' => 'image|mimes:jpeg,png,jpg|max:2048| ' . ($tksk ? 'nullable' : 'required'),
        ];
    }
}
