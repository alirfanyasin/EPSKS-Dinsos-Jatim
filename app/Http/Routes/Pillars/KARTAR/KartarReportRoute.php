<?php

namespace App\Http\Routes\Pillars\KARTAR;

use App\Http\Controllers\Pillars\KARTAR\KartarReportController;
use Dentro\Yalr\BaseRoute;

class KartarReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/kartar/report/';
    protected string $name = 'app.pillar.kartar.report';
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
        $this->router->get($this->prefix('show'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);
        $this->router->get($this->prefix('edit/{id}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);
        $this->router->post($this->prefix('update'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);
        $this->router->delete($this->prefix('delete/{id}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);


        $this->router->get($this->prefix('revisi/{id}'), [
            'as' => $this->name('revisi'),
            'uses' => $this->uses('revisi')
        ]);

        $this->router->post($this->prefix('revisi-update'), [
            'as' => $this->name('revisi-update'),
            'uses' => $this->uses('revisi_update')
        ]);

        $this->router->get($this->prefix('exportReport/{select}'), [
            'as' => $this->name('exportReport'),
            'uses' => $this->uses('exportReport')
        ]);

        $this->router->post($this->prefix('export_pdf/{name}'), [
            'as' => $this->name('export_pdf'),
            'uses' => $this->uses('export_pdf')
        ]);

        $this->router->get($this->prefix('export_excel/{select}'), [
            'as' => $this->name('export_excel'),
            'uses' => $this->uses('export_excel')
        ]);
    }

    public function controller(): string
    {
        return KartarReportController::class;
    }
}
