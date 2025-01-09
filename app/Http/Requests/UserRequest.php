<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin') | $user->hasRole('ops');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Username harus diisi',
            'name.unique' => 'Username sudah dimiliki orang lain',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format Email tidak sesuai',
            'password.required' => 'Password harud diisi'
        ];
    }
}
