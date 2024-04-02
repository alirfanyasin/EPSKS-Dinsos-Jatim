<?php

namespace App\Http;

use App\Models\Pillars\PSM\PSM;
use App\Models\Pillars\PSM\PSMReport;
use App\Models\Pillars\PSM\PSMTraining;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\Pillars\TKSK\TKSKReport;
use App\Models\Pillars\TKSK\TKSKTraining;
use Dentro\Yalr\Contracts\Bindable;
use Illuminate\Routing\Router;

/**
 * Class RouteModelBinding
 * @package App\Http
 * @author Chrisdion Andrew <iniandrewrp@gmail.com>
 */

class RouteModelBinding implements Bindable
{
    public function __construct(protected Router $router)
    { }

    public function bind(): void
    {
        $this->router->bind('tksk_hash', fn ($key) => TKSK::byHashOrFail($key));
        $this->router->bind('tksk_training_hash', fn ($key) => TKSKTraining::byHashOrFail($key));
        $this->router->bind('tksk_report_hash', fn ($key) => TKSKReport::byHashOrFail($key));
        $this->router->bind('psm_hash', fn ($key) => PSM::byHashOrFail($key));
        $this->router->bind('psm_training_hash', fn ($key) => PSMTraining::byHashOrFail($key));
        $this->router->bind('psm_report_hash', fn ($key) => PSMReport::byHashOrFail($key));
    }
}
