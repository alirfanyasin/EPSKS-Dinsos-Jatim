<?php

namespace App\Http\Routes\Pillars\KARTAR;

use App\Http\Controllers\Pillars\KARTAR\KartarMemberController;
use Dentro\Yalr\BaseRoute;

class KartarMemberRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/kartar/member';
    protected string $name = 'app.pillar.kartar.member';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix('create/{id}'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);

        $this->router->get($this->prefix('show/{member_id}/{kartar_id}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->post($this->prefix('store/{id}'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->get($this->prefix('edit/{member_id}/{kartar_id}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);
        $this->router->post($this->prefix('update/{member_id}/{kartar_id}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('delete'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);
    }


    public function controller(): string
    {
        return KartarMemberController::class;
    }
}
