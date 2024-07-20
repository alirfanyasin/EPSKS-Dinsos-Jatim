<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Preloads
    |--------------------------------------------------------------------------
    | String of class name that instance of \Dentro\Yalr\Contracts\Bindable
    | Preloads will always been called even when laravel routes has been cached.
    | It is the best place to put Rate Limiter and route binding related code.
    */

    'preloads' => [
        App\Http\RouteModelBinding::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Router group settings
    |--------------------------------------------------------------------------
    | Groups are used to organize and group your routes. Basically the same
    | group that used in common laravel route.
    |
    | 'group_name' => [
    |     // laravel group route options can contains 'middleware', 'prefix',
    |     // 'as', 'domain', 'namespace', 'where'
    | ]
    */

    'groups' => [
        'web' => [
            'middleware' => ['web', 'auth:sanctum', 'verified'],
            'prefix' => '',
        ],
        'api' => [
            'middleware' => 'api',
            'prefix' => 'api',
        ],
        'guest' => [
            'middleware' => ['web'],
            'prefix' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    | Below is where our route is loaded, it read `groups` section above.
    | keys in this array are the name of route group and values are string
    | class name either instance of \Dentro\Yalr\Contracts\Bindable or
    | controller that use attribute that inherit \Dentro\Yalr\RouteAttribute
    */
    'web' => [
        App\Http\Routes\DefaultRoute::class,
        App\Http\Routes\AccountRoute::class,
        App\Http\Routes\ComplaintRoute::class,
        // App\Http\Routes\Pillars\KartarRoute::class,
        App\Http\Routes\IndoRegionRoute::class,
        App\Http\Routes\Pillars\LKS\LKSRoute::class,
        App\Http\Routes\Pillars\LKS\LKSAccreditation::class,
        App\Http\Routes\Pillars\LKS\LKSManagement::class,
        App\Http\Routes\Pillars\LKS\LKSTrainingManagement::class,
        App\Http\Routes\Pillars\LKS\LKSClient::class,
        App\Http\Routes\ReportCodeManagementRoute::class,
        App\Http\Routes\ReportRoute::class,
        App\Http\Routes\Pillars\LKS\LKSReportRoute::class,
        App\Http\Routes\Pillars\KARTAR\KartarProfileRoute::class,
        App\Http\Routes\Pillars\KARTAR\KartarMemberRoute::class,
        App\Http\Routes\Pillars\KARTAR\KartarMemberTrainingRoute::class,
        App\Http\Routes\Pillars\KARTAR\KartarReportRoute::class,
        App\Http\Routes\Pillars\KARTAR\KartarReportApprovalRoute::class,
        App\Http\Routes\Pillars\LKS\LKSReportReviewRoute::class,

        // tksk
        App\Http\Routes\Pillars\TKSK\TKSKRoute::class,
        App\Http\Routes\Pillars\TKSK\TKSKTrainingRoute::class,
        App\Http\Routes\Pillars\TKSK\TKSKReportRoute::class,
        App\Http\Routes\Pillars\TKSK\TKSKReportApprovalRoute::class,

        // psm
        \App\Http\Routes\Pillars\PSM\PSMProfileRoute::class,
        \App\Http\Routes\Pillars\PSM\PSMTrainingRoute::class,
        \App\Http\Routes\Pillars\PSM\PSMReportRoute::class,
        \App\Http\Routes\Pillars\PSM\PSMReportApprovalRoute::class,

        App\Http\Routes\Pillars\PKH\PKHProfileRoute::class,
        App\Http\Routes\Pillars\PKH\PKHReportRoute::class,
        App\Http\Routes\Pillars\ASPD\ASPDProfileRoute::class,
        App\Http\Routes\Pillars\ASPD\ASPDReportRoute::class,
        App\Http\Routes\Pillars\ASPD\ASPDReportApprovalRoute::class,
        App\Http\Routes\Pillars\PKH\PKHTraining::class,
        App\Http\Routes\Pillars\PKH\PKHReportApprovalRoute::class,
        /** @inject web **/
    ],
    'api' => [
        /** @inject api **/
    ],
    'guest' => [
        App\Http\Routes\EmployeeAuthRoute::class,
    ],
];
