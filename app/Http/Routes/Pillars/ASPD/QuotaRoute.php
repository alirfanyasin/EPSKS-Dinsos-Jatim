<?php

namespace App\Http\Routes\Pillars\ASPD;

use App\Http\Controllers\Pillars\ASPD\QuotaController;
use Dentro\Yalr\BaseRoute;

class QuotaRoute extends BaseRoute
{

    protected string $prefix = 'app/pillar/aspd/quota';
    protected string $name = 'app.pillar.aspd.quota';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix('index'), [
            'as' => $this->name('index'),
            'uses' => $this->uses('index')
        ]);
        $this->router->get($this->prefix('create'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);
        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);
        $this->router->get($this->prefix('edit/{id}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);
        $this->router->post($this->prefix('update/{id}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);
        $this->router->post($this->prefix('reset/{id}'), [
            'as' => $this->name('reset'),
            'uses' => $this->uses('reset')
        ]);
    }

    public function controller(): string
    {
        return QuotaController::class;
    }
}
