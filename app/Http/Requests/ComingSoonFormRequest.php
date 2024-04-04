<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Concern\UserAdmin;

class ComingSoonFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sender_first_name' => 'string|required',
            'sender_last_name' => 'string|nullable',
            'sender_email' => 'required|email',
            'sender_phone' => 'numeric|nullable',
            // 'sender_id' => 'required|integer',

            // 'receiver_id' => 'required|integer',
            // 'receiver_email' => 'required|email',
            // 'receiver_first_name' => 'string|required',
            // 'receiver_last_name' => 'string|nullable',

            'content' => 'required|nullable',
            // 'subject' => 'nullable',
            // 'read' => 'nullable',

        ];
    }

    protected function prepareForValidation(): void
    {
        $userAdmin  = new UserAdmin;
        $this->merge([
            'receiver_id' => $userAdmin->getUserAdminId(),
            'receiver_email' => $userAdmin->getUserAdmin()->email,
            'receiver_first_name' => $userAdmin->getUserAdmin()->first_name,
            'receiver_last_name' => $userAdmin->getUserAdmin()->last_name,
        ]);
    }
}
