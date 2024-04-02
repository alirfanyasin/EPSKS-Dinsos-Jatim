<?php

namespace App\Actions\Pillars\TKSK;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKTraining;
use Illuminate\Http\Request;

/**
 * Class TKSKTrainingAction
 * Author: Chrisdion Andrew
 * Date: 6/29/2023 11:55 AM
 */

class TKSKTrainingAction
{
    use Validation;
    use HandleAttachment;

    protected Request $request;
    protected string $documentPath = 'pillars/tksk';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(TKSK $tksk): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $training = new TKSKTraining();
        $training->tksk_id = $tksk->id;
        $training->name = $filteredRequest['name'];
        $training->organizer = $filteredRequest['organizer'];
        $training->certificate = $this->storeDocument($filteredRequest['certificate'], $this->documentPath);

        return $training->save();
    }

    public function update(TKSKTraining $training): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules($training));

        $training->name = $filteredRequest['name'];
        $training->organizer = $filteredRequest['organizer'];

        if ($this->request->hasFile('certificate')) {
            $this->deleteAttachment($training->certificate);
            $training->certificate = $this->storeDocument($filteredRequest['certificate'], $this->documentPath);
        }

        return $training->save();
    }

    public function delete(TKSKTraining $training): bool
    {
        $this->deleteAttachment($training->certificate);
        return $training->delete();
    }

    private function rules(?TKSKTraining $training = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'certificate' => 'mimes:pdf|max:10240|' . ($training ? 'nullable' : 'required'),
        ];
    }
}
