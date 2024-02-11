<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'category_id' => ['exists:categories,id'],
            'title' => ['required', 'max:1000'],
            'description' => ['required'],
            'price' => ['min:1'],
            'days' => ['min:1'],
            'isUrgent' => ['sometimes'],
            'isSafe' => ['sometimes'],
            'created_at' => ['sometimes'],
            'tags' => ['sometimes'],
        ];
    }
}
