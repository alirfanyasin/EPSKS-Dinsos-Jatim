<?php

namespace App\Http\Routes\Pillars\TKSK;

use App\Http\Controllers\Pillars\TKSK\TKSKTrainingController;
use Dentro\Yalr\BaseRoute;

/**
 * Class TKSKTrainingRoute
 * Author: Chrisdion Andrew
 * Date: 6/29/2023
 */

class TKSKTrainingRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/tksk/training/';
    protected string $name = 'app.pillar.tksk.training';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->post($this->prefix('{tksk_hash}/training/store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->put($this->prefix('edit/{tksk_training_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('training/delete/{tksk_training_hash}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);
    }

    public function controller(): string
    {
        return TKSKTrainingController::class;
    }
}
