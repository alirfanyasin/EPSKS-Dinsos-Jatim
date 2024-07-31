<?php

namespace App\Http\Routes\Pillars\ASPD;

use App\Http\Controllers\Pillars\ASPD\ASPDReportApprovalController;
use Dentro\Yalr\BaseRoute;

class ASPDReportApprovalRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/aspd/report/approval/';
    protected string $name = 'app.pillar.aspd.report.approval';
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

        $this->router->post($this->prefix('update-status/{id}'), [
            'as' => $this->name('update-status'),
            'uses' => $this->uses('updateStatus')
        ]);


        // make an awesome route
    }



    public function controller(): string
    {
        return ASPDReportApprovalController::class;
    }
}
