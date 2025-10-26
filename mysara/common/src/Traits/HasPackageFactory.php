<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

trait HasPackageFactory
{
    use HasFactory;

    protected static function newFactory()
    {
        $package   = Str::before(get_called_class(), 'Models\\');
        $modelName = Str::after(get_called_class(), 'Models\\');
        $path      = $package.'Factories\\'.$modelName.'Factory';

        return new $path;
    }
}
