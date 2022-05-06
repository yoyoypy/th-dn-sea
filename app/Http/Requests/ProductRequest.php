<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'slug' => 'unique:products,slug',
            'user_id' => 'exists:user,id',
            'category_id' => 'exists:categories,id|required',
            'category_details_id' => 'exists:category_details,id|required',
            'category_type_id' => 'exists:category_types,id|required',
            'job_id' => 'exists:class_jobs,id|required',
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|integer',
            'rc'    => 'required|integer',
            'value' => 'string'
        ];
    }
}
