<?php

namespace App\Http\Routes;

use App\Http\Controllers\ComplaintController;
use Dentro\Yalr\BaseRoute;

/**
 * Class ComplaintRoute
 * @package App\Http\Routes
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class ComplaintRoute extends BaseRoute
{
    protected string $prefix = 'app/complaint/';
    protected string $name = 'app.complaint';

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

        $this->router->delete($this->prefix('delete/{id}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return ComplaintController::class;
    }


}
