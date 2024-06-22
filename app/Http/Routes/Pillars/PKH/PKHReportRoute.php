<?php

namespace App\Http\Routes\Pillars\PKH;

use App\Http\Controllers\Pillars\PKH\PKHReportController;
use Dentro\Yalr\BaseRoute;

class PKHReportRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/pkh/report/';
    protected string $name = 'app.pillar.pkh.report';
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
        return PKHReportController::class;
    }
}
