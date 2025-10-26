<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Controllers;

use Exception;
use Illuminate\Http\Request;
use MySara\Common\Repositories\CatalogRepo;
use MySara\Common\Repositories\CategoryRepo;
use MySara\Common\Repositories\CurrencyRepo;
use MySara\Common\Repositories\MailRepo;
use MySara\Common\Repositories\PageRepo;
use MySara\Common\Repositories\SettingRepo;
use MySara\Common\Repositories\WeightClassRepo;
use MySara\Common\Services\AI\AIServiceManager;
use MySara\Panel\Repositories\ContentAIRepo;
use MySara\Panel\Repositories\ThemeRepo;
use Throwable;

class SettingController
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        $data = [
            'locales'        => locales()->toArray(),
            'currencies'     => CurrencyRepo::getInstance()->enabledList()->toArray(),
            'weight_classes' => WeightClassRepo::getInstance()->withActive()->all()->toArray(),
            'categories'     => CategoryRepo::getInstance()->getTwoLevelCategories(),
            'catalogs'       => CatalogRepo::getInstance()->getTopCatalogs(),
            'pages'          => PageRepo::getInstance()->withActive()->builder()->get(),
            'themes'         => ThemeRepo::getInstance()->getListFromPath(),
            'mail_engines'   => MailRepo::getInstance()->getEngines(),
            'ai_models'      => AIServiceManager::getInstance()->getModelsForSelect(),
            'ai_prompts'     => ContentAIRepo::getInstance()->getPrompts(),
        ];

        return inno_view('panel::settings.index', $data);
    }

    /**
     * @param  Request  $request
     * @return mixed
     * @throws Throwable
     */
    public function update(Request $request): mixed
    {
        $settings = $request->all();

        try {
            SettingRepo::getInstance()->updateValues($settings);
            $oldAdminName = panel_name();
            $newAdminName = $settings['panel_name'] ?? 'panel';
            $settingUrl   = str_replace($oldAdminName, $newAdminName, panel_route('settings.index'));

            return redirect($settingUrl)
                ->with('instance', $settings)
                ->with('success', panel_trans('common.updated_success'));
        } catch (Exception $e) {
            return redirect(panel_route('settings.index'))->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
