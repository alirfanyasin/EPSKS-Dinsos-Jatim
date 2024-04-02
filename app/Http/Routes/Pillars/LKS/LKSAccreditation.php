<?php

namespace App\Http\Routes\Pillars\LKS;

use App\Http\Controllers\Pillars\LKS\LKSAccreditationController;
use Dentro\Yalr\BaseRoute;

class LKSAccreditation extends BaseRoute
{
    protected string $prefix = 'app/pillar/lks/accreditation';
    protected string $name = 'app.pillar.lks.accreditation';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->post($this->prefix('store'), [
            'as' => $this->name('store'),
            'uses' => $this->uses('store')
        ]);

        $this->router->put($this->prefix('update/{lks_accreditation_hash}'), [
            'as' => $this->name('update'),
            'uses' => $this->uses('update')
        ]);

        $this->router->delete($this->prefix('destroy/{lks_accreditation_hash}'), [
            'as' => $this->name('destroy'),
            'uses' => $this->uses('destroy')
        ]);
    }

    public function controller(): string
    {
        return LKSAccreditationController::class;
    }
}
