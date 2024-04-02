<?php

namespace App\Http\Routes\Pillars\LKS;

use App\Http\Controllers\Pillars\LKS\LKSReportController;
use Dentro\Yalr\BaseRoute;

class LKSReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/lks/report/';
    protected string $name = 'app.pillar.lks.report';
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

        $this->router->get($this->prefix('edit/{lks_report_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->put($this->prefix('update/{lks_report_hash}/{type}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->get($this->prefix('lks/{lks_hash}'), [
            'as' => $this->name('lks_report'),
            'uses' => $this->uses('lks_report')
        ]);

        $this->router->get($this->prefix('export-report'), [
            'as' => $this->name('exportReport'),
            'uses' => $this->uses('exportReport')
        ]);

        $this->router->post($this->prefix('export-report/export'), [
            'as' => $this->name('export'),
            'uses' => $this->uses('export')
        ]);

    }

    public function controller(): string
    {
        return LKSReportController::class;
    }
}
