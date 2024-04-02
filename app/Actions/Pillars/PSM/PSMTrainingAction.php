<?php

namespace App\Actions\Pillars\PSM;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\PSM\PSMTraining;
use Illuminate\Http\Request;

/**
 * Class PSMTrainingAction
 * Author: Andrew
 */
class PSMTrainingAction
{
    use Validation;
    use HandleAttachment;

    public function __construct(
        protected ?Request $request = null,
        protected string $documentPath = 'pillars/psm'
    ) {
    }

    public function create(PSM $psm): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $training = new PSMTraining();
        $training->psm_id = $psm->id;
        $training->name = $filteredRequest['name'];
        $training->organizer = $filteredRequest['organizer'];
        $training->certificate = $this->storeDocument($filteredRequest['certificate'], $this->documentPath);

        return $training->save();
    }

    public function update(PSMTraining $training): bool
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

    public function delete(PSMTraining $training): bool
    {
        $this->deleteAttachment($training->certificate);
        return $training->delete();
    }

    private function rules(?PSMTraining $training = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'certificate' => 'mimes:pdf|max:10240|' . ($training ? 'nullable' : 'required'),
        ];
    }
}
