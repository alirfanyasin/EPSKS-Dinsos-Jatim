<?php

namespace App\Http\Routes\Pillars\LKS;

use App\Http\Controllers\Pillars\LKS\LKSTrainingManagementController;
use Dentro\Yalr\BaseRoute;

class LKSTrainingManagement extends BaseRoute
{
    protected string $prefix = 'app/pillar/lks/{lks_hash}/management/{lks_management}/training';
    protected string $name = 'app.pillar.lks.management.training';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix(), [
            'as' => $this->name('index'),
            'uses' => $this->uses('index')
        ]);

        $this->router->get($this->prefix('create'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);

        $this->router->get($this->prefix('show'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->put($this->prefix('update/{lks_training_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('destroy/{lks_training_hash}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return LKSTrainingManagementController::class;
    }
}
