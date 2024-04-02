<?php

namespace App\Providers;

 use App\Models\Pillars\Pillar;
 use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-tksk', function (User $user) {
            return $user->hasRole('super-admin') || ($user->hasRole('admin') && $user->pillar?->id === Pillar::PILLAR_TKSK);
        });
    }
}
