<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PublishFrontTheme extends Command
{
    protected $signature = 'inno:publish-theme';

    protected $description = 'Publish default theme for frontend.';

    public function handle(): void
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'MySara\Front\FrontServiceProvider',
            '--tag'      => 'views',
        ]);
        echo Artisan::output();
    }
}
