<?php

namespace App\Http\Routes;

use App\Http\Controllers\ReportCodeManagementController;
use Dentro\Yalr\BaseRoute;

/**
 * Class ReportCodeRoute
 * Author: Chrisdion Andrew
 * Date: 6/29/2023
 */

class ReportCodeManagementRoute extends BaseRoute
{
    protected string $prefix = 'app/report-code-management/';
    protected string $name = 'app.report-code-management';

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

        $this->router->post($this->prefix('bulk-store'), [
            'as' => $this->name('bulk-store'),
            'uses' => $this->uses('bulkStore')
        ]);
    }

    public function controller(): string
    {
        return ReportCodeManagementController::class;
    }
}
