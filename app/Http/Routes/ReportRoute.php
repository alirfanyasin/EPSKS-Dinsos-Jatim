<?php

namespace App\Http\Routes;

use App\Http\Controllers\ReportController;
use Dentro\Yalr\BaseRoute;

/**
 * This routes is used for pillars TKSK and PSM
 * Class ReportRoute
 * Author: Chrisdion Andrew
 * Date: 8/29/2023
 */

class ReportRoute extends BaseRoute
{
    protected string $name = 'app.employee.report';
    protected string $prefix = 'app/report/';

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

        $this->router->get($this->prefix('detail/{hash}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('edit/{hash}/'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('{type}/update/{hash}/'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->get($this->prefix('export'), [
            'as' => $this->name('export'),
            'uses' => $this->uses('export')
        ]);

        $this->router->post($this->prefix('export'), [
            'as' => $this->name('doExport'),
            'uses' => $this->uses('doExport')
        ]);
    }

    public function controller(): string
    {
        return ReportController::class;
    }
}
