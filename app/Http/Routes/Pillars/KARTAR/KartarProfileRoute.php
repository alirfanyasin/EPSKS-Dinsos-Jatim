<?php

namespace App\Http\Routes\Pillars\KARTAR;

use App\Http\Controllers\Pillars\KARTAR\KartarController;
use Dentro\Yalr\BaseRoute;

class KartarProfileRoute extends BaseRoute
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

        $this->router->get($this->prefix('import'), [
            'as' => $this->name('import'),
            'uses' => $this->uses('import')
        ]);
        $this->router->post($this->prefix('import-excel'), [
            'as' => $this->name('import-excel'),
            'uses' => $this->uses('importExcel')
        ]);
    }

    public function controller(): string
    {
        return KartarController::class;
    }
}
