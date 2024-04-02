<?php

namespace App\Actions\Pillars\LKS;

use App\Concerns\Validation;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSClient;
use Illuminate\Http\Request;

class LKSClientAction
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

        // handle file
        $fileKTP = $this->request->file('attachments.ktp');
        $nameFileKTP = time() . '_front_' . $fileKTP->getClientOriginalName();
        $fileKTP->move('storage/pillars/lks/client/', $nameFileKTP);

        $fileKK = $this->request->file('attachments.kk');
        $nameFileKK = time() . '_identity_' . $fileKK->getClientOriginalName();
        $fileKK->move('storage/pillars/lks/client/', $nameFileKK);

        $attachments = [
            'ktp' => $nameFileKTP,
            'kk' => $nameFileKK
        ];

        $post = new LKSClient;

        $post->fill($this->request->all());
        $post->lks_id = $lks->id;
        $post->attachments = $attachments;

        $result = $post->save();

        return $result;
    }

    public function update($LKSClient): bool
    {
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($LKSClient)));

        $attachments = [
            'ktp' => $LKSClient->attachments['ktp'],
            'kk' => $LKSClient->attachments['kk'],
        ];

        // handdle update attachments
        if ($this->request->hasFile('attachments.ktp')) {
            $fileKTP = $this->request->file('attachments.ktp');
            $nameFileKTP = time() . '_' . $fileKTP->getClientOriginalName();
            $fileKTP->move('storage/pillars/lks/client/', $nameFileKTP);
            $destroyKTP = public_path() . '\\storage\\pillars\\lks\\client\\' . $LKSClient->attachments['ktp'];
            unlink($destroyKTP);

            $attachments['ktp'] = $nameFileKTP;
        }

        if ($this->request->hasFile('attachments.kk')) {
            $fileKK = $this->request->file('attachments.kk');
            $nameFileKK = time() . '_' . $fileKK->getClientOriginalName();
            $fileKK->move('storage/pillars/lks/client/', $nameFileKK);
            $destroyKK = public_path() . '\\storage\\pillars\\lks\\client\\' . $LKSClient->attachments['kk'];
            unlink($destroyKK);

            $attachments['kk'] = $nameFileKK;
        }

        $collectRequest = collect($this->request->all());

        $LKSClient->fill($collectRequest->except(['attachments'])->toArray());
        $LKSClient->attachments = $attachments;

        $result = $LKSClient->save();

        return $result;
    }

    private function rules(?LKSClient $LKSClient = null): array
    {
        return [
            'name' => 'required',
            'attachments' => 'array|' . ($LKSClient ? 'nullable' : 'required'),
            'attachments.*' => 'file|mimes:jpg,jpeg,png|' . ($LKSClient ? 'nullable' : 'required'),
            'address' => 'required|array',
            'address.*' => 'required',
            'nik' => 'required|max_digits:16',
            'family_card_number' => 'required|max_digits:16',
            'gender' => 'required',
            'religion' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'last_education' => 'required',
        ];
    }
}
