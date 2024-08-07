<?php

namespace App\Jobs\Users;

use App\Models\Pillars\Pillar;
use App\Models\Pillars\PKH\PKH;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class CreateNewUserAfterPKHCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected PKH $pkh)
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
            'name' => $this->pkh->name,
            'nip' => $this->pkh->id . "" . Str::random(4),
            'username' => $this->pkh->name . Str::random(7),
            'email' => $this->pkh->email ?? '',
            'password' => $this->pkh->nik,
            'office_id' => $this->pkh->office_id,
            'pillar_id' => Pillar::PILLAR_PKH,
            'is_employee' => true,
        ]);

        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        // update the pkh user_id
        $this->pkh->update([
            'user_id' => $user->id,
        ]);
    }
}
