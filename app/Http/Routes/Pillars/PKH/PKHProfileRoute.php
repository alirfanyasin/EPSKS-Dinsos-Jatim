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

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->get($this->prefix('show/{id}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('edit/{id}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->post($this->prefix('update/{id}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);
        $this->router->delete($this->prefix('delete/{id}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);
    }

    public function controller(): string
    {
        return PKHController::class;
    }
}
