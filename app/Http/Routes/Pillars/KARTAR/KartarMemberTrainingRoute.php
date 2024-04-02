<?php

namespace App\Http\Routes\Pillars\KARTAR;

use App\Http\Controllers\Pillars\KARTAR\KartarMemberTrainingController;
use Dentro\Yalr\BaseRoute;

class KartarMemberTrainingRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/kartar/member/training';
    protected string $name = 'app.pillar.kartar.member.training';

    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->post($this->prefix('store/{member_id}/{kartar_id}'), [
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
        return KartarMemberTrainingController::class;
    }
}
