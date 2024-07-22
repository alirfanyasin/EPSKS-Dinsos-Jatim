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
        $this->router->get($this->prefix('revision/{id}'), [
            'as' => $this->name('revision'),
            'uses' => $this->uses('revision')
        ]);
        $this->router->post($this->prefix('revision-update/{id}'), [
            'as' => $this->name('revision-update'),
            'uses' => $this->uses('revisionUpdate')
        ]);

        $this->router->get($this->prefix('exportReport/{select}'), [
            'as' => $this->name('exportReport'),
            'uses' => $this->uses('exportReport')
        ]);

        $this->router->post($this->prefix('export_pdf'), [
            'as' => $this->name('export_pdf'),
            'uses' => $this->uses('export_pdf')
        ]);
    }

    public function controller(): string
    {
        return PKHReportController::class;
    }
}
