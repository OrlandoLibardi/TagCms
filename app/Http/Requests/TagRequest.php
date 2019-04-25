<?php

namespace OrlandoLibardi\MenuCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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

        switch($this->method()){
            case 'POST':
                $rules = [
                    'tag_name'  => 'required|string|max:255',
                    'tag_value' => 'required'
                ];   
            break;
            case 'DELETE':
                $rules = [
                    'tag_name' => 'required' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    
    }
    
}
