<?php

namespace App\Http\Requests;

use App\Enums\Permissions\UserPermissionType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()?->can(UserPermissionType::EDIT_USER);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'min:3|max:200',
            'password' => 'required_with:password_confirm',
            'password_confirm' => 'required_with:password|same:password',
        ];
    }
}
