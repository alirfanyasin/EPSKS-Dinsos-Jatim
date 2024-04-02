<?php

namespace App\Http\Routes\Pillars\LKS;

use App\Http\Controllers\Pillars\LKS\LKSReviewReportController;
use Dentro\Yalr\BaseRoute;

class LKSReportReviewRoute extends BaseRoute
{
    protected string $prefix = 'app/pillar/lks/approval';
    protected string $name = 'app.pillar.lks.approval';
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

        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->get($this->prefix('show/{lks_client_hash}'), [
            'as' => $this->name('show'),
            'uses' => $this->uses('show')
        ]);

        $this->router->get($this->prefix('edit/{lks_hash}'), [
            'as' => $this->name('edit'),
            'uses' => $this->uses('edit')
        ]);

        $this->router->put($this->prefix('update/{lks_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('destroy/{lks_client_hash}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return LKSReviewReportController::class;
    }
}
