<?php

namespace App\Http\Routes;

use App\Http\Controllers\Auth\EmployeeAuthController;
use Dentro\Yalr\BaseRoute;

class EmployeeAuthRoute extends BaseRoute
{
    protected string $prefix = 'employee/auth/login';
    protected string $name = 'employee.auth.login';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix, [
            'as' => $this->name,
            'uses' => $this->uses('showLoginForm')
        ]);

        $this->router->post($this->prefix, [
            'as' => $this->name('authenticate'),
            'uses' => $this->uses('authenticate')
        ]);
    }

    public function controller(): string
    {
        return EmployeeAuthController::class;
    }
}
