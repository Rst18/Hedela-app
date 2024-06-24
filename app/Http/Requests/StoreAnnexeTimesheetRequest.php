<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnexeTimesheetRequest extends FormRequest
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
                'max:1024', // Maximum file size in kilobytes (adjust as needed)
                // 'mimeTypes' => ['pdf', 'docx', 'doc','png'], // Allowed MIME types (adjust as needed)
            ],
            'timesheet_id'=>'required|exists:timesheets,id'
        ];
    }
}
