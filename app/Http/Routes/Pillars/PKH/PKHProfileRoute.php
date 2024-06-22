<?php

namespace App\Http\Routes\Pillars\PKH;

use App\Http\Controllers\Pillars\PKH\PKHController;
use Dentro\Yalr\BaseRoute;

class PKHProfileRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/pkh/';
    protected string $name = 'app.pillar.pkh';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        // make an awesome route
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
        return PKHController::class;
    }
}
