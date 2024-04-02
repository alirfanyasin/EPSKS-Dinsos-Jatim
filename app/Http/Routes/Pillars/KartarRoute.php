<?php

namespace App\Http\Routes\Pillars;

use App\Http\Controllers\Pillars\KartarController;
use Dentro\Yalr\BaseRoute;

class KartarRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/kartar/';
    protected string $name = 'app.pillar.kartar';
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

        $this->router->get($this->prefix('edit/{id}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->get($this->prefix('show/{id}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('add-management/{id}'), [
            'as' => $this->name('addManagement'),
            'uses' => $this->uses('addManagement')
        ]);

        $this->router->get($this->prefix('edit-management/{id}'), [
            'as' => $this->name('editManagement'),
            'uses' => $this->uses('editManagement')
        ]);

        $this->router->get($this->prefix('report/{id}'), [
            'as' => $this->name('report'),
            'uses' => $this->uses('report')
        ]);

        $this->router->get($this->prefix('report/add-report/{id}'), [
            'as' => $this->name('addReport'),
            'uses' => $this->uses('addReport')
        ]);
    }

    public function controller(): string
    {
        return KartarController::class;
    }
}
