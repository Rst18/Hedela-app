<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
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
            
            'task_id'=>'required|exists:tasks,id',
            'description'=>'required|string',
            'date_debut'=>'date',
            'date_jour'=>'required|date',
            'date_fin'=>'date',
            'user_id'=>'required|exists:users,id',
            'timesheet_files'=> [
                'required',
                //'files', // Rule for uploaded file
               // 'max:1024', // Maximum file size in kilobytes (adjust as needed)
                // 'mimeTypes' => ['pdf', 'docx', 'doc','png'], // Allowed MIME types (adjust as needed)
            ],
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
