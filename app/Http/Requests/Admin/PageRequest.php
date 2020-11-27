<?php

namespace App\Http\Requests\Admin;

use App\Enums\PageGroup;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
