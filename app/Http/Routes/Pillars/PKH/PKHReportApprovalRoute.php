<?php

namespace App\Http\Routes\Pillars\PKH;

use Dentro\Yalr\BaseRoute;

class PKHReportApprovalRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/pkh/report/approval/';
    protected string $name = 'app.pillar.pkh.report.approval';
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
    }
}
