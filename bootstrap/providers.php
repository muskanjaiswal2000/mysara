<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,

    MySara\Install\InstallServiceProvider::class,
    MySara\Common\CommonServiceProvider::class,
    MySara\Panel\PanelServiceProvider::class,
    MySara\Front\FrontServiceProvider::class,
    MySara\RestAPI\RestAPIServiceProvider::class,
    MySara\Plugin\PluginServiceProvider::class,
];
