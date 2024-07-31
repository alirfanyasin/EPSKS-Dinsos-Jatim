<?php

namespace App\Http\Routes;

use App\Http\Controllers\ProfileController;
use Dentro\Yalr\BaseRoute;

class ProfileRoute extends BaseRoute
{
    protected string $prefix = 'app/profile/';
    protected string $name = 'app.profile';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix('index'), [
            'as' => $this->name('index'),
            'uses' => $this->uses('index'),
        ]);
        $this->router->get($this->prefix('change-password'), [
            'as' => $this->name('change-password'),
            'uses' => $this->uses('changePassword')
        ]);
        $this->router->post($this->prefix('change-password-action'), [
            'as' => $this->name('change-password-action'),
            'uses' => $this->uses('changePasswordAction')
        ]);
    }

    public function controller(): string
    {
        return ProfileController::class;
    }
}
