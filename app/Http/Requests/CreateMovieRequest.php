<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
            'photo_id'=>'required',
            'country'=>'required',
            'name'=>'required',
            'year'=>'required',
            'rate'=>'required',
            'story'=>'required',
            'trailer'=>'required',
            'wserverone'=>'required',          
            'dserverone'=>'required',
        ];
    }
}
