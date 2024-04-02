<?php

namespace App\Http\Routes\Pillars\TKSK;

use App\Http\Controllers\Pillars\TKSK\TKSKReportApprovalController;
use Dentro\Yalr\BaseRoute;

/**
 * Class TKSKReportApprovalRoute
 * Author: Chrisdion Andrew
 * Date: 7/9/2023
 */

class TKSKReportApprovalRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/tksk/report/approval/';
    protected string $name = 'app.pillar.tksk.report.approval';

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

        $this->router->get($this->prefix('{tksk_report_hash}/detail'), [
            'as' => $this->name('detail'),
            'uses' => $this->uses('detail')
        ]);

        $this->router->post($this->prefix('{tksk_report_hash}/store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('approval')
        ]);
    }

    public function controller(): string
    {
        return TKSKReportApprovalController::class;
    }
}
