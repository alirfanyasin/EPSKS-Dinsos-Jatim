<?php

namespace App\Http\Routes\Pillars\PKH;

use App\Http\Controllers\Pillars\PKH\PKHReportController;
use Dentro\Yalr\BaseRoute;

class PKHReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/pkh/report/';
    protected string $name = 'app.pillar.pkh.report';
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

        $this->router->delete($this->prefix('destroy/{id}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return PKHReportController::class;
    }
}
