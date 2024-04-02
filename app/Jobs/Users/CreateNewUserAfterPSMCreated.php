<?php

namespace App\Jobs\Users;

use App\Models\Pillars\Pillar;
use App\Models\Pillars\PSM\PSM;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;

class CreateNewUserAfterPSMCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected PSM $psm
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

        $user = User::query()->create([
            'name' => $this->psm->name,
            'nip' => $this->psm->membership_number,
            'username' => $this->psm->membership_number,
            'email' => strtolower(str_replace(' ', '_', $this->psm->name)) . '_' . $this->psm->membership_number . '@mail.com',
            'password' => $this->psm->membership_number,
            'office_id' => $this->psm->office_id,
            'pillar_id' => Pillar::PILLAR_PSM,
            'is_employee' => true,
        ]);

        $user->assignRole($role?->name);
        $user->syncPermissions($role?->permissions);

        // update the TKSK user_id
        $this->psm->update([
            'user_id' => $user->id,
        ]);
    }
}
