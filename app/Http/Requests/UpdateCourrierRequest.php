<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourrierRequest extends FormRequest
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
        return [
            'number'=>'required|string',
            'sender'=>'required|string',
            'email'=>'email|required',
            'phone'=>'string|required',
            'objet'=>'string|required',
            'letter_number'=>'string|required',
            'annexes'=>'integer|required',
            'service_id'=>'required|exists:services,id',
            'type_courrier_id'=>'required|exists:type_courriers,id',
            // 'letter_file' => [
            //     'required',
            //     'file', // Rule for uploaded file
            //     'max:1024', // Maximum file size in kilobytes (adjust as needed)
            //     Rule::mimeTypes(['pdf', 'docx', 'doc']), // Allowed MIME types (adjust as needed)
            // ],
            'user_id'=>'required|exists:users,id'
        ];
    }
}
