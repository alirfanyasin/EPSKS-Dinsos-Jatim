<?php

namespace App\Jobs\Users;

use App\Models\Pillars\LKS\LKS;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class CreateNewUserAfterLKSCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected LKS $lks,
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

        $user = User::query()->create([
            'name' => $this->lks->name,
            'nip' => $this->lks->id."".Str::random(4),
            'username' => $this->lks->npwp,
            'email' => Str::random(5). "@mail.com",
            'password' => $this->lks->npwp,
            'office_id' => $this->lks->office_id,
            'pillar_id' => Pillar::PILLAR_LKS,
            'is_employee' => true,
        ]);

        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        // update the LKS user_id
        $this->lks->update([
            'user_id' => $user->id,
        ]);

    }
}
