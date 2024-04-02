<?php

namespace App\Http\Routes\Pillars\PSM;

use App\Http\Controllers\Pillars\PSM\PSMProfileController;
use Dentro\Yalr\BaseRoute;

class PSMProfileRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/psm/';
    protected string $name = 'app.pillar.psm.profile';


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

        $this->router->get($this->prefix('import'), [
            'as' => $this->name('import'),
            'uses' => $this->uses('import')
        ]);

        $this->router->get($this->prefix('show/{psm_hash}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('create'), [
            'as' => $this->name('create'),
            'uses' => $this->uses('create')
        ]);

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->get($this->prefix('edit/{psm_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('edit/{psm_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('delete/{psm_hash}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);

        $this->router->get($this->prefix('{psm_hash}/report/'), [
            'as' => $this->name('report'),
            'uses' => $this->uses('report')
        ]);
    }


    public function controller(): string
    {
        return PSMProfileController::class;
    }
}
