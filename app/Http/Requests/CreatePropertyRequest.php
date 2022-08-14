<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $town
 * @property mixed $parent_property_id
 * @property mixed $organisation
 * @property mixed $property_type
 * @property mixed $uprn
 * @property mixed $address
 * @property mixed $postcode
 * @property mixed $live
 */
class CreatePropertyRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'organisation' => 'required',
            'property_type' => 'required',
            'uprn' => 'required',
            'address' => 'required',
            'live' => 'required',
        ];
    }
}
