<?php

namespace App\Http\Routes\Pillars\TKSK;

use App\Http\Controllers\Pillars\TKSK\TKSKReportController;
use Dentro\Yalr\BaseRoute;

class TKSKReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/tksk/report/';
    protected string $name = 'app.pillar.tksk.report';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix, [
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

        $this->router->get($this->prefix('edit/{tksk_report_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->post($this->prefix('update/{tksk_report_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('destroy/{tksk_report_hash}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return TKSKReportController::class;
    }
}
