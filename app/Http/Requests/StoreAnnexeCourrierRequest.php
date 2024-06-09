<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnexeCourrierRequest extends FormRequest
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
            'name'=>'required',
            'path' => [
                'required',
                'file', // Rule for uploaded file
                'max:5024', // Maximum file size in kilobytes (adjust as needed)
                //'mimeTypes' => ['pdf', 'docx', 'doc'], // Allowed MIME types (adjust as needed)
            ],
            'courrier_id'=>'required|exists:courriers,id'
        ];
    }
}
