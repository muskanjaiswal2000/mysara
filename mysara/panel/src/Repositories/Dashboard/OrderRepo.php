<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Repositories\Dashboard;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use MySara\Common\Services\StateMachineService;
use MySara\Panel\Repositories\BaseRepo;

class OrderRepo extends BaseRepo
{
    /**
     * Retrieve the number of new articles added each day in the past week.
     *
     * @return array
     */
    public function getOrderCountLatestWeek(): array
    {
        $filters = [
            'start'    => today()->subWeek(),
            'end'      => today()->endOfDay(),
            'statuses' => StateMachineService::getValidStatuses(),
        ];
        $articleTotals = \MySara\Common\Repositories\OrderRepo::getInstance()->builder($filters)
            ->select(DB::raw('DATE(created_at) as date, count(*) as total'))
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $dates  = $totals = [];
        $period = CarbonPeriod::create(today()->subWeek(), today())->toArray();
        foreach ($period as $date) {
            $dateFormat   = $date->format('Y-m-d');
            $articleTotal = $articleTotals[$dateFormat] ?? null;

            $dates[]  = $dateFormat;
            $totals[] = $articleTotal ? $articleTotal->total : 0;
        }

        return [
            'period' => $dates,
            'totals' => $totals,
        ];
    }

    /**
     * Retrieve the number of new articles added each day in the past month.
     *
     * @return array
     */
    public function getOrderCountLatestMonth(): array
    {
        $filters = [
            'start'    => today()->subMonth(),
            'end'      => today()->endOfDay(),
            'statuses' => StateMachineService::getValidStatuses(),
        ];
        $articleTotals = \MySara\Common\Repositories\OrderRepo::getInstance()->builder($filters)
            ->select(DB::raw('DATE(created_at) as date, count(*) as total'))
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $dates  = $totals = [];
        $period = CarbonPeriod::create(today()->subMonth(), today())->toArray();
        foreach ($period as $date) {
            $dateFormat   = $date->format('Y-m-d');
            $articleTotal = $articleTotals[$dateFormat] ?? null;

            $dates[]  = $dateFormat;
            $totals[] = $articleTotal ? $articleTotal->total : 0;
        }

        return [
            'period' => $dates,
            'totals' => $totals,
        ];
    }
}
