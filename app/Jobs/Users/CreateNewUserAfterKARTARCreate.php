<?php

namespace App\Jobs\Users;

use App\Models\Pillars\Kartar\KarangTaruna;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class CreateNewUserAfterKARTARCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected KarangTaruna $kartar,
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

        $user = User::query()->create([
            'name' => $this->kartar->nama_kartar,
            'nip' => $this->kartar->id."".Str::random(4),
            'username' => Str::random(7),
            'email' => $this->kartar->email_kartar ?? '',
            'password' => $this->kartar->no_telp_sekretariat,
            'office_id' => $this->kartar->office_id,
            'pillar_id' => Pillar::PILLAR_KARTAR,
            'is_employee' => true,
        ]);

        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        // update the KARTAR user_id
        $this->kartar->update([
            'user_id' => $user->id,
        ]);
    }
}
