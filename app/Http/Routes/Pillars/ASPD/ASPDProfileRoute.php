<?php

namespace App\Http\Routes\Pillars\ASPD;

use App\Http\Controllers\Pillars\ASPD\ASPDController;
use Dentro\Yalr\BaseRoute;

class ASPDProfileRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/aspd/';
    protected string $name = 'app.pillar.aspd';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix('index'), [
            'as' => $this->name('index'),
            'uses' => $this->uses('profile')
        ]);

        $this->router->get($this->prefix('create'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);
    }

    public function controller(): string
    {
        return ASPDController::class;
    }
}
