<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class idenUploadRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'Rider_id' => 'required|string',
            'Rider_name' => 'required|string',
            'Id_photo' => 'required',
            'Id_number' => 'required|string',
        ];
    }
}
