<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoryId = $this->route('category') ? $this->route('category')->id : null;

        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'parent_id' => 'nullable|exists:categories,id',
            'type' => $categoryId ? 'nullable|in:income,expense' : 'required|in:income,expense',
        ];
    }

    public function attributes()
    {
        return [
            'parent_id' => 'Parent Category',
            'type' => 'Category Type',
        ];
    }
}
