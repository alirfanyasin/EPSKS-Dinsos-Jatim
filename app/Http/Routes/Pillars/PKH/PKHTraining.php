<?php

namespace App\Http\Routes\Pillars\PKH;

use App\Http\Controllers\Pillars\PKH\PKHTrainingController;
use Dentro\Yalr\BaseRoute;

class PKHTraining extends BaseRoute
{

    protected string $prefix = 'app/pillar/pkh/training/';
    protected string $name = 'app.pillar.pkh.training';

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
        return PKHTrainingController::class;
    }
}
