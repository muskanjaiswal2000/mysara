<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
        ];

        if ($this->customer) {
            $rules['email'] = 'required|email:rfc|unique:customers,email,'.$this->customer->id;
        } else {
            $rules['email'] = 'required|email:rfc|unique:customers,email';
        }

        if ($this->request->get('password') && ! is_admin()) {
            $rules['password'] = 'required|confirmed';
        }

        return $rules;
    }
}
