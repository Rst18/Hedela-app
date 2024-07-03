<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourrierSortantRequest extends FormRequest
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
            'requested'=>'required|string',
            'letter_file' => [
                'required',
                'file', // Rule for uploaded file
                //'max:10024', // Maximum file size in kilobytes (adjust as needed)
                //'mimeTypes' => ['pdf', 'docx', 'doc'], // Allowed MIME types (adjust as needed)
            ],
            'accuse_reception_file' => [
                
                'file', // Rule for uploaded file
                //'max:10024', // Maximum file size in kilobytes (adjust as needed)
                //'mimeTypes' => ['pdf', 'docx', 'doc'], // Allowed MIME types (adjust as needed)
            ],
            'user_id'=>'required|exists:users,id'
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
