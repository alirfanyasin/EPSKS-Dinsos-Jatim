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
        $this->router->get($this->prefix('create/{pkh_id}'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);

        $this->router->post($this->prefix('store/{pkh_id}'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->delete($this->prefix('delete'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);
    }

    public function controller(): string
    {
        return PKHTrainingController::class;
    }
}
