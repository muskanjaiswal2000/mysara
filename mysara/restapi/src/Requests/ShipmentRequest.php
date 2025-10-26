<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'express_code'    => 'required|string',
            'express_company' => 'required|string',
            'express_number'  => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'express_code'    => trans('panel/shipment.express_code'),
            'express_company' => trans('panel/shipment.express_company'),
            'express_number'  => trans('panel/shipment.express_number'),
        ];
    }
}
