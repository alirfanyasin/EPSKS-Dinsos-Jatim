<?php

namespace App\Http\Routes;

use App\Http\Controllers\AccountController;
use Dentro\Yalr\BaseRoute;

/**
 * Class AccountRoute
 * @package App\Http\Routes
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class AccountRoute extends BaseRoute
{
    protected string $prefix = 'app/account/';
    protected string $name = 'app.account';

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

        $this->router->get($this->prefix('show'), [
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

        $this->router->get($this->prefix('edit'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('edit'), [
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
        return AccountController::class;
    }
}
