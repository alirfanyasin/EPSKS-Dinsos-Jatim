<?php

namespace App\Actions\Pillars\LKS;

use App\Concerns\Validation;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSAccreditation;
use Illuminate\Http\Request;

class LKSAccreditationAction
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

        //handle file
        $file = $this->request->file('attachment');
        $nameFile = time().'_'.$file->getClientOriginalName();
        $file->move('storage/pillars/lks/accreditation/', $nameFile);

        $post = new LKSAccreditation;

        $post->lks_id = $lks->id;
        $post->assessment_year = $this->request->assessment_year;
        $post->grade = $this->request->grade;
        $post->attachment = $nameFile;

        $result = $post->save();

        return $result;
    }

    public function update($LKSAccreditation): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($LKSAccreditation)));

        $LKSAccreditation->assessment_year = $this->request->assessment_year;
        $LKSAccreditation->grade = $this->request->grade;

        if ($this->request->hasFile('attachment')) {
            //handle file
            $file = $this->request->file('attachment');
            $nameFile = time().'_'.$file->getClientOriginalName();
            $file->move('storage/pillars/lks/accreditation/', $nameFile);
            $destroy = public_path().'\\storage\\pillars\\lks\\accreditation\\'. $LKSAccreditation->attachment;
            unlink($destroy);

            $LKSAccreditation->attachment = $nameFile;
        }

        $result = $LKSAccreditation->save();

        return $result;
    }

    private function rules(?LKSAccreditation $LKSAccreditation = null): array
    {
        return [
            'assessment_year' => 'required',
            'grade' => 'required',
            'attachment' => 'file|mimes:pdf|' . ($LKSAccreditation ? 'nullable' : 'required'),
        ];
    }
}
