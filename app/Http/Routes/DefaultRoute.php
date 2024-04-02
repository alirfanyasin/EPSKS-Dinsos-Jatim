<?php

namespace App\Http\Routes;

use App\Http\Controllers\DashboardController;
use Dentro\Yalr\BaseRoute;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/**
 * Class DefaultRoute
 * @package App\Http\Routes
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class DefaultRoute extends BaseRoute
{
    protected string $prefix = 'app/';
    protected string $name = 'app';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->redirect('/', 'app/dashboard');

        $this->router->get($this->prefix('dashboard'), DashboardController::class)->name($this->name('dashboard'));

    }
}
