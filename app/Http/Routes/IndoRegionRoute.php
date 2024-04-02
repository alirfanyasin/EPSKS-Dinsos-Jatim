<?php

namespace App\Http\Routes;

use App\Http\Controllers\IndoRegionController;
use Dentro\Yalr\BaseRoute;

class IndoRegionRoute extends BaseRoute
{
    protected string $prefix = 'app/region/';
    protected string $name = 'app.region';
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->get($this->prefix('getDistricts/{id}'), [
            'as' => $this->name('getDistricts'),
            'uses' => $this->uses('getDistricts')
        ]);

        $this->router->get($this->prefix('getVillages/{id}'), [
            'as' => $this->name('getVillages'),
            'uses' => $this->uses('getVillages')
        ]);
    }

    public function controller(): string
    {
        return IndoRegionController::class;
    }
}
