<?php

namespace App\Http\Routes\Pillars\LKS;

use App\Http\Controllers\Pillars\LKS\LKSController;
use Dentro\Yalr\BaseRoute;

class LKSRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/lks/';
    protected string $name = 'app.pillar.lks';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix(), [
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

        $this->router->get($this->prefix('show/{lks_hash}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('edit/{lks_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('update/{lks_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('destroy/{lks_hash}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);

        $this->router->get($this->prefix('import'), [
            'as' => $this->name('import'),
            'uses' => $this->uses('import')
        ]);

        $this->router->get($this->prefix('exportData'), [
            'as' => $this->name('exportBnba'),
            'uses' => $this->uses('exportBnba')
        ]);

        $this->router->post($this->prefix('importData'), [
            'as' => $this->name('importBnba'),
            'uses' => $this->uses('importBnba')
        ]);
    }

    public function controller(): string
    {
        return LKSController::class;
    }
}
