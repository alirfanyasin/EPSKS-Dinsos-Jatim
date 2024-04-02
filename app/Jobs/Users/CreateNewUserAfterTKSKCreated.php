<?php

namespace App\Jobs\Users;

use App\Models\Pillars\Pillar;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;

/**
 * Class CreateNewUserAfterCreatedMembership
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class CreateNewUserAfterTKSKCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * This job will be executed after the TKSK is created.
     */
    public function __construct(
        protected TKSK $tksk,
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

        $user = User::query()->create([
            'name' => $this->tksk->name,
            'nip' => $this->tksk->membership_number,
            'username' => $this->tksk->membership_number,
            'email' => strtolower(str_replace(' ', '_', $this->tksk->name)) . '_' . $this->tksk->membership_number . '@mail.com',
            'password' => $this->tksk->membership_number,
            'office_id' => $this->tksk->office_id,
            'pillar_id' => Pillar::PILLAR_TKSK,
            'is_employee' => true,
        ]);

        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        // update the TKSK user_id
        $this->tksk->update([
            'user_id' => $user->id,
        ]);
    }
}
