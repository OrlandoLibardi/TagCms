<?php

namespace OrlandoLibardi\TagCms\app\Http\Requests;

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
                    'tags.*'  => 'required|string|max:255',
                ];   
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    
    }
    
}
