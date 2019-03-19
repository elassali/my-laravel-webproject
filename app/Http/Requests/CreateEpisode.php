<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEpisode extends FormRequest
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
            'serie_id'=>'required',
            'season_id'=>'required',
            'episode_number'=>'required',
            'wserverone'=>'required',
            'wservertwo'=>'required',
            'wserverthree'=>'required',
            'wserverfour'=>'required',
            'wserverfive'=>'required',
            'dserverone'=>'required',
            'dservertwo'=>'required',          
        ];
    }
}
