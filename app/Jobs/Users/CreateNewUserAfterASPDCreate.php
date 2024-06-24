<?php

namespace App\Jobs\Users;

use App\Models\Pillars\ASPD\ASPD;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class CreateNewUserAfterASPDCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ASPD $aspd)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

        $user = User::query()->create([
            'name' => $this->aspd->name,
            'nip' => $this->aspd->id . "" . Str::random(4),
            'username' => $this->aspd->name . Str::random(7),
            'email' => strtolower(trim($this->aspd->name)) . Str::random(4) . '@gmail.com' ?? '',
            'password' => $this->aspd->nik,
            'office_id' => $this->aspd->office_id,
            'pillar_id' => Pillar::PILLAR_ASPD,
            'is_employee' => true,
        ]);

        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        // update the aspd user_id
        $this->aspd->update([
            'user_id' => $user->id,
        ]);
    }
}
