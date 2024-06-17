<?php

namespace App\Http\Routes\Pillars\ASPD;

use App\Http\Controllers\Pillars\ASPD\ASPDReportController;
use Dentro\Yalr\BaseRoute;

class ASPDReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/aspd/report/';
    protected string $name = 'app.pillar.aspd.report';
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

    public function controller(): string
    {
        return ASPDReportController::class;
    }
}
