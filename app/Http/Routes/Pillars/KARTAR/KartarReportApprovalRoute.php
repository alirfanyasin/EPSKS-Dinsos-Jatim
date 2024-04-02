<?php

namespace App\Http\Routes\Pillars\KARTAR;

use App\Http\Controllers\Pillars\KARTAR\KartarReportApprovalController;
use Dentro\Yalr\BaseRoute;

class KartarReportApprovalRoute extends BaseRoute
{

    protected string $prefix = 'app/pillar/kartar/report/approval/';
    protected string $name = 'app.pillar.kartar.report.approval';
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

        $this->router->post($this->prefix('verification/{id}'), [
            'as' => $this->name('verification'),
            'uses' => $this->uses('verification')
        ]);
    }

    public function controller(): string
    {
        return KartarReportApprovalController::class;
    }
}
