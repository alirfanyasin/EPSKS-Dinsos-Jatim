<?php

namespace App\Http\Routes\Pillars\PSM;

use App\Http\Controllers\Pillars\PSM\PSMReportApprovalController;
use Dentro\Yalr\BaseRoute;

class PSMReportApprovalRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/psm/report/approval/';
    protected string $name = 'app.pillar.psm.report.approval';

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

        $this->router->get($this->prefix('{psm_report_hash}/detail'), [
            'as' => $this->name('detail'),
            'uses' => $this->uses('detail')
        ]);

        $this->router->post($this->prefix('{psm_report_hash}/store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('approval')
        ]);
    }

    public function controller(): string
    {
        return PSMReportApprovalController::class;
    }
}
