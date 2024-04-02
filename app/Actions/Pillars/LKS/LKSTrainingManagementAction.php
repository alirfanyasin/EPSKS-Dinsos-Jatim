<?php

namespace App\Actions\Pillars\LKS;

use App\Concerns\Validation;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSTrainingManagement;
use Illuminate\Http\Request;

class LKSTrainingManagementAction
{
    use Validation;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create($LKSManagement): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        // handle file
        $file = $this->request->file('attachment');
        $nameFile = time().'_'.$file->getClientOriginalName();
        $file->move('storage/pillars/lks/training/', $nameFile);

        $post = new LKSTrainingManagement;

        $post->lks_management_id = $LKSManagement->id;
        $post->name = $this->request->name;
        $post->organizer = $this->request->organizer;
        $post->date = $this->request->date;
        $post->attachment = $nameFile;

        $result = $post->save();

        return $result;
    }

    public function update($LKSTrainingManagement): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($LKSTrainingManagement)));

        $LKSTrainingManagement->name = $this->request->name;
        $LKSTrainingManagement->organizer = $this->request->organizer;
        $LKSTrainingManagement->date = $this->request->date;

        if ($this->request->hasFile('attachment')) {

            //handle file
            $file = $this->request->file('attachment');
            $nameFile = time().'_'.$file->getClientOriginalName();
            $file->move('storage/pillars/lks/training/', $nameFile);
            $destroy = public_path().'\\storage\\pillars\\lks\\training\\'. $LKSTrainingManagement->attachment;
            unlink($destroy);

            $LKSTrainingManagement->attachment = $nameFile;
        }

        $result = $LKSTrainingManagement->save();

        return $result;
    }

    private function rules(?LKSTrainingManagement $LKSTrainingManagement = null): array
    {
        return [
            'name' => 'required',
            'organizer' => 'required',
            'date' => 'required',
            'attachment' => 'file|mimes:pdf|' . ($LKSTrainingManagement ? 'nullable' : 'required'),
        ];
    }
}
