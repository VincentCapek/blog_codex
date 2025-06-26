<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('post')->id ?? null;

        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:posts,slug,'.$postId],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
            'status' => ['in:draft,published'],
        ];
    }
}
