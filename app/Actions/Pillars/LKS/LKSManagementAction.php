<?php

namespace App\Actions\Pillars\LKS;

use App\Concerns\Validation;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSManagement;
use Illuminate\Http\Request;

class LKSManagementAction
{
    use Validation;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create($lks): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $post = new LKSManagement;

        $post->lks_id = $lks->id;
        $post->name = $this->request->name;
        $post->nik = $this->request->nik;
        $post->gender = $this->request->gender;
        $post->religion = $this->request->religion;
        $post->start_working = $this->request->start_working;
        $post->place_of_birth = $this->request->place_of_birth;
        $post->date_of_birth = $this->request->date_of_birth;
        $post->position = $this->request->position;
        $post->employee_status = $this->request->employee_status;
        $post->last_education = $this->request->last_education;

        $result = $post->save();

        return $result;
    }

    public function update($LKSManagement): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules()));

        $LKSManagement->name = $this->request->name;
        $LKSManagement->nik = $this->request->nik;
        $LKSManagement->gender = $this->request->gender;
        $LKSManagement->religion = $this->request->religion;
        $LKSManagement->place_of_birth = $this->request->place_of_birth;
        $LKSManagement->date_of_birth = $this->request->date_of_birth;
        $LKSManagement->start_working = $this->request->start_working;
        $LKSManagement->position = $this->request->position;
        $LKSManagement->employee_status = $this->request->employee_status;
        $LKSManagement->last_education = $this->request->last_education;

        $result = $LKSManagement->save();

        return $result;
    }

    private function rules(): array
    {
        return [
            'name' => 'required',
            'nik' => 'required|max_digits:16',
            'gender' => 'required',
            'religion' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'start_working' => 'required',
            'position' => 'required',
            'employee_status' => 'required',
            'last_education' => 'required'
        ];
    }
}
