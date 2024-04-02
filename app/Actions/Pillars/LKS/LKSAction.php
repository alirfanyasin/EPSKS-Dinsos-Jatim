<?php

namespace App\Actions\Pillars\LKS;

use App\Concerns\Validation;
use App\Jobs\Users\CreateNewUserAfterLKSCreated;
use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\LKS\LKSService;
use App\Models\Office;
use Illuminate\Http\Request;
use Auth;

class LKSAction
{
    use Validation;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getQuery()
    {
        $query = LKS::query();
        if (Auth::user()->office_id != 1) {
            $query->where('office_id', $this->request->user()->office_id);
        }
        $query->latest();

        return $query;
    }

    public function create(): bool
    {
        // $id = Office::where('name', 'like', '%'. $this->request->address['regency'])->first();
        // dd($id->id);
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        // handle file
        $fileFrontPhoto = $this->request->file('attachments.front');
        $nameFileFront = time().'_front_'.$fileFrontPhoto->getClientOriginalName();
        $fileFrontPhoto->move('storage/pillars/lks/bnba/', $nameFileFront);

        $fileLeaderIdentity = $this->request->file('attachments.ktp_leader');
        $nameFileIdentity = time().'_identity_'.$fileLeaderIdentity->getClientOriginalName();
        $fileLeaderIdentity->move('storage/pillars/lks/bnba/', $nameFileIdentity);

        $fileNPWP = $this->request->file('attachments.npwp');
        $nameFileNPWP = time().'_npwp_'.$fileNPWP->getClientOriginalName();
        $fileNPWP->move('storage/pillars/lks/bnba/', $nameFileNPWP);

        $filePhotoLeader = $this->request->file('attachments.leader_photo');
        $nameFilePhotoLeader = time().'_leader_'.$filePhotoLeader->getClientOriginalName();
        $filePhotoLeader->move('storage/pillars/lks/bnba/', $nameFilePhotoLeader);

        $filePhotoBoard = $this->request->file('attachments.board');
        $nameFilePhotoBoard = time().'_board_'.$filePhotoBoard->getClientOriginalName();
        $filePhotoBoard->move('storage/pillars/lks/bnba/', $nameFilePhotoBoard);

        $fileSK = $this->request->file('attachments.sk');
        $nameFileSK = time().'_sk_'.$fileSK->getClientOriginalName();
        $fileSK->move('storage/pillars/lks/bnba/', $nameFileSK);

        $fileAkta = $this->request->file('attachments.akta');
        $nameFileAkta = time().'_akta_'.$fileAkta->getClientOriginalName();
        $fileAkta->move('storage/pillars/lks/bnba/', $nameFileAkta);

        if ($this->request->hasFile('siop_attachments.prov') == true) {
            $fileSIOPProv = $this->request->file('siop_attachments.prov');
            $nameFileSIOPProv = time().'_siop_prov_'.$fileSIOPProv->getClientOriginalName();
            $fileSIOPProv->move('storage/pillars/lks/bnba/', $nameFileSIOPProv);
        }

        if ($this->request->hasFile('siop_attachments.regency') == true) {
            $fileSIOPRegency = $this->request->file('siop_attachments.regency');
            $nameFileSIOPregency = time().'_siop_regency_'.$fileSIOPRegency->getClientOriginalName();
            $fileSIOPRegency->move('storage/pillars/lks/bnba/', $nameFileSIOPregency);
        }

        $attachments = [
            'front' => $nameFileFront,
            'ktp_leader' => $nameFileIdentity,
            'npwp' => $nameFileNPWP,
            'leader_photo' => $nameFilePhotoLeader,
            'board' => $nameFilePhotoBoard,
            'sk' => $nameFileSK,
            'akta' => $nameFileAkta
        ];

        if ($this->request->hasFile('siop_attachments.prov') == true && $this->request->hasFile('siop_attachments.regency') == true) {
            $siopAttachments = [
                'prov' => $nameFileSIOPProv,
                'regency' => $nameFileSIOPregency
            ];
        }
        else if($this->request->hasFile('siop_attachments.regency') == false && $this->request->hasFile('siop_attachments.prov') == true){
            $siopAttachments = [
                'prov' => $nameFileSIOPProv,
                'regency' => null,
            ];
        }
        else if($this->request->hasFile('siop_attachments.regency') == true && $this->request->hasFile('siop_attachments.prov') == false){
            $siopAttachments = [
                'prov' => null,
                'regency' => $nameFileSIOPregency
            ];
        }
        else{
            $siopAttachments = [
                'prov' => null,
                'regency' => null
            ];
        }

        $this->lks = new LKS();
        $this->lks->fill($filteredRequest);
        $this->lks->attachments = $attachments;
        $this->lks->siop_attachments = $siopAttachments;
        if ($this->request->user()->office_id == 1) {
            $office = Office::where('name', 'like', '%'. $this->request->address['regency'])->first();
            $this->lks->office_id = $office->id;
        }else{
            $this->lks->office_id = $this->request->user()->office_id;
        }

        $result = $this->lks->save();

        foreach ($this->request->services as $service) {
            $this->lksService = new LKSService;

            $this->lksService->lks_id = $this->lks->id;
            $this->lksService->service = $service;

            $this->lksService->save();
        }

        CreateNewUserAfterLKSCreated::dispatch($this->lks);

        return $result;
    }

    public function update($dataLKS): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($dataLKS)));

        $import = 1;
        if ($dataLKS->attachments != null) {
            $attachments = [
                'front' => $dataLKS->attachments['front'],
                'ktp_leader' => $dataLKS->attachments['ktp_leader'],
                'npwp' => $dataLKS->attachments['npwp'],
                'leader_photo' => $dataLKS->attachments['leader_photo'],
                'board' => $dataLKS->attachments['board'],
                'sk' => $dataLKS->attachments['sk'],
                'akta' => $dataLKS->attachments['akta']
            ];
            $import = 0;
        }

        if ($import == 1) {
            CreateNewUserAfterLKSCreated::dispatch($dataLKS);
        }

        // handdle update attachments
        if ($this->request->hasFile('attachments.front')) {
            $fileFrontPhoto = $this->request->file('attachments.front');
            $nameFileFront = time().'_front_'.$fileFrontPhoto->getClientOriginalName();
            $fileFrontPhoto->move('storage/pillars/lks/bnba/', $nameFileFront);
            if ($import == 0) {
                $destroyFront = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['front'];
                unlink($destroyFront);
            }

            $attachments['front'] = $nameFileFront;
        }

        if ($this->request->hasFile('attachments.ktp_leader')) {
            $fileLeaderIdentity = $this->request->file('attachments.ktp_leader');
            $nameFileIdentity = time().'_identity_'.$fileLeaderIdentity->getClientOriginalName();
            $fileLeaderIdentity->move('storage/pillars/lks/bnba/', $nameFileIdentity);
            if ($import == 0) {
                $destroyidentityLeader = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['ktp_leader'];
                unlink($destroyidentityLeader);
            }

            $attachments['ktp_leader'] = $nameFileIdentity;
        }

        if ($this->request->hasFile('attachments.npwp')) {
            $fileNPWP = $this->request->file('attachments.npwp');
            $nameFileNPWP = time().'_npwp_'.$fileNPWP->getClientOriginalName();
            $fileNPWP->move('storage/pillars/lks/bnba/', $nameFileNPWP);
            if ($import ==0) {
                $destroyNPWP = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['npwp'];
                unlink($destroyNPWP);
            }

            $attachments['npwp'] = $nameFileNPWP;
        }

        if ($this->request->hasFile('attachments.leader_photo')) {
            $filePhotoLeader = $this->request->file('attachments.leader_photo');
            $nameFilePhotoLeader = time().'_leader_'.$filePhotoLeader->getClientOriginalName();
            $filePhotoLeader->move('storage/pillars/lks/bnba/', $nameFilePhotoLeader);
            if ($import == 0) {
                $destroyLeaderPhoto = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['leader_photo'];
                unlink($destroyLeaderPhoto);
            }

            $attachments['leader_photo'] = $nameFilePhotoLeader;
        }

        if ($this->request->hasFile('attachments.board')) {
            $filePhotoBoard = $this->request->file('attachments.board');
            $nameFilePhotoBoard = time().'_board_'.$filePhotoBoard->getClientOriginalName();
            $filePhotoBoard->move('storage/pillars/lks/bnba/', $nameFilePhotoBoard);
            if ($import == 0) {
                $destroyLeaderPhoto = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['board'];
                unlink($destroyLeaderPhoto);
            }

            $attachments['board'] = $nameFilePhotoBoard;
        }

        if ($this->request->hasFile('attachments.sk')) {
            $fileSK = $this->request->file('attachments.sk');
            $nameFileSK = time().'_sk_'.$fileSK->getClientOriginalName();
            $fileSK->move('storage/pillars/lks/bnba/', $nameFileSK);
            if ($import == 0) {
                $destroySK = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['sk'];
                unlink($destroySK);
            }

            $attachments['sk'] = $nameFileSK;
        }

        if ($this->request->hasFile('attachments.akta')) {
            $fileAkta = $this->request->file('attachments.akta');
            $nameFileAkta = time().'_akta_'.$fileAkta->getClientOriginalName();
            $fileAkta->move('storage/pillars/lks/bnba/', $nameFileAkta);
            if ($import == 0) {
                $destroyAkta = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->attachments['akta'];
                unlink($destroyAkta);
            }

            $attachments['akta'] = $nameFileAkta;
        }

        // handdle update siop attachments
        if ($dataLKS->siop_attachments != null) {
            $siopAttachments = [
                'prov' => $dataLKS->siop_attachments['prov'],
                'regency' => $dataLKS->siop_attachments['regency']
            ];
        }
        else{
            $siopAttachments = [
                'prov' => null,
                'regency' => null
            ];
        }

        if ($this->request->hasFile('siop_attachments.prov')) {
            $fileSIOPProv = $this->request->file('siop_attachments.prov');
            $nameFileSIOPProv = time().'_siop_prov_'.$fileSIOPProv->getClientOriginalName();
            $fileSIOPProv->move('storage/pillars/lks/bnba/', $nameFileSIOPProv);
            if ($import == 0) {
                $destroySiopProv = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->siop_attachments['prov'];
                unlink($destroySiopProv);
            }

            $siopAttachments['prov'] = $nameFileSIOPProv;
        }

        if ($this->request->hasFile('siop_attachments.regency')) {
            $fileSIOPRegency = $this->request->file('siop_attachments.regency');
            $nameFileSIOPregency = time().'_siop_regency_'.$fileSIOPRegency->getClientOriginalName();
            $fileSIOPRegency->move('storage/pillars/lks/bnba/', $nameFileSIOPregency);
            if ($import == 0) {
                $destroySiopRegency = public_path().'\\storage\\pillars\\lks\\bnba\\'. $dataLKS->siop_attachments['regency'];
                unlink($destroySiopRegency);
            }

            $siopAttachments['regency'] = $nameFileSIOPregency;
        }

        $collectRequest = collect($this->request->all());

        $dataLKS->fill($collectRequest->except(['attachments', 'siop_attachments'])->toArray());
        $dataLKS->attachments = $attachments;
        $dataLKS->siop_attachments = $siopAttachments;
        if ($this->request->user()->office_id == 1) {
            $office = Office::where('name', 'like', '%'. $this->request->address['regency'])->first();
            $dataLKS->office_id = $office->id;
        }else{
            $dataLKS->office_id = $this->request->user()->office_id;
        }

        $result = $dataLKS->save();

        $deleteService = LKSService::where('lks_id', $dataLKS->id)->get();
        foreach ($deleteService as $item) {
            $destroy = LKSService::where('id', $item->id)->first();
            $destroy->delete();
        }

        foreach ($this->request->services as $service) {
            $lksService = new LKSService;

            $lksService->lks_id = $dataLKS->id;
            $lksService->service = $service;

            $lksService->save();
        }

        return $result;
    }

    private function rules(?LKS $dataLKS = null): array
    {
        return [
            'name' => 'required',
            'attachments' => 'array|' . ($dataLKS ? 'nullable' : 'required'),
            'attachments.*' => 'file|' . ($dataLKS ? 'nullable' : 'required'),
            'address' => 'required|array',
            'address.*' => 'required',
            'services' => 'required',
            'owner' => 'required',
            'phone_number' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'leader_name' => 'required',
            'phone_number_leader' => 'required',
            'clients' => 'required|array',
            'clients.*' => 'required',
            'since' => 'required',
            'npwp' => 'required|unique:lks,npwp,' . $dataLKS?->id,
            'kemenkumham_number' => 'required',
            'sk_date' => 'required',
            'notary_name' => 'required',
            'number_akta' => 'required',
            'akta_date' => ' required',
            'prov_siop_number' => 'nullable',
            'prov_siop_date' => 'nullable',
            'regency_siop_number' => 'nullable',
            'regency_siop_date' => 'nullable'
        ];
    }
}
