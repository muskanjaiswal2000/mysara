<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Interfaces;

interface Translator
{
    public function translate($from, $to, $text): string;

    public function batchTranslate($from, $to, $texts): array;

    public function mapCode($code): string;
}
