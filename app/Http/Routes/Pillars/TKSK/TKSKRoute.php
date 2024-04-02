<?php

namespace App\Http\Routes\Pillars\TKSK;

use App\Http\Controllers\Pillars\TKSK\TKSKController;
use Dentro\Yalr\BaseRoute;

/**
 * Class TKSKRoute
 * @package App\Http\Routes\Pillars
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class TKSKRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/tksk/';
    protected string $name = 'app.pillar.tksk';

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

        $this->router->get($this->prefix('show/{tksk_hash}'), [
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

        $this->router->get($this->prefix('edit/{tksk_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('edit/{tksk_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('delete/{tksk_hash}'), [
            'as' => $this->name('delete'),
            'uses' => $this->uses('delete')
        ]);

        $this->router->get($this->prefix('{tksk_hash}/report'), [
            'as' => $this->name('personal.report'),
            'uses' => $this->uses('report')
        ]);

        $this->router->get($this->prefix('import'), [
            'as' => $this->name('import'),
            'uses' => $this->uses('import')
        ]);

        $this->router->post($this->prefix('import'), [
            'as' => $this->name('import.store'),
            'uses' => $this->uses('doImport')
        ]);
    }

    public function controller(): string
    {
        return TKSKController::class;
    }
}
