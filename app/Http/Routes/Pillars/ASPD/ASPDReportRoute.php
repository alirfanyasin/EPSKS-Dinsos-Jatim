<?php

namespace App\Http\Routes\Pillars\ASPD;

use App\Http\Controllers\Pillars\ASPD\ASPDReportController;
use Dentro\Yalr\BaseRoute;

class ASPDReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/aspd/report/';
    protected string $name = 'app.pillar.aspd.report';
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

        $this->router->post($this->prefix('exportReport/{select}'), [
            'as' => $this->name('exportReport'),
            'uses' => $this->uses('exportReport')
        ]);

        $this->router->post($this->prefix('export_pdf'), [
            'as' => $this->name('export_pdf'),
            'uses' => $this->uses('export_pdf')
        ]);

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->get($this->prefix('show/{id}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);
    }

    public function controller(): string
    {
        return ASPDReportController::class;
    }
}
