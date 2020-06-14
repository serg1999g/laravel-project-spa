<?php

namespace Modules\Mission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissionRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required|string:500',
            'content'=>'required|string|max:500',
            'location'=>'required|string|max:255',
            'language'=>'required|string|max:255',
            'duration'=>'required|string|max:255',
            'start'=>'required|string|max:255',
        ];
    }
}
