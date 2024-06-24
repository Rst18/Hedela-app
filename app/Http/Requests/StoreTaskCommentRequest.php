<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskCommentRequest extends FormRequest
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
                'commentaire'=>'required|string',
                'user_id'=>'required|exists:users,id',
                'parentId'=>'integer'
            ];
        }
    
        public function PrepareForValidation(){
            
            $this->mergeIfMissing([
                
                'user_id'=>Auth::user()->id
            ]);
        }
}
