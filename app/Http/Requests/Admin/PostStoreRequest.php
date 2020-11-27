<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'type' => ['required'],
            'text' => ['required_if:type,text'],
            'video' => ['required_if:type,video'],
            'file' => ['required_if:type,file'],
            'image' => ['required_if:type,image'],
            'category' => ['required'],
            'body' => ['required'],
        ];
    }
}
