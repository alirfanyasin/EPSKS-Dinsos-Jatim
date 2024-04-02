<?php

namespace App\Http\Routes\Pillars\PSM;

use App\Http\Controllers\Pillars\PSM\PSMTrainingController;
use Dentro\Yalr\BaseRoute;

class PSMTrainingRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/psm/training/';
    protected string $name = 'app.pillar.psm.training';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->post($this->prefix('{psm_hash}/training/store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->put($this->prefix('edit/{psm_training_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('training/delete/{psm_training_hash}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);
    }

    public function controller(): string
    {
        return PSMTrainingController::class;
    }
}
