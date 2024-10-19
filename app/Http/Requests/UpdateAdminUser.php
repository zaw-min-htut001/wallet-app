<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminUserId = $this->route('user') ? $this->route('user') : null; // Get the ID from route if updating
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('admin_users')->ignore($adminUserId)],
            'phone' => ['required', Rule::unique('admin_users')->ignore($adminUserId) ,'max:11'],
            'password' => ['required', 'min:5', 'max:10'],
        ];
    }
}
