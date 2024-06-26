<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreAudienceRequest extends FormRequest
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
              'email'=>'required|email',
              'phone'=>'required',
              'motif'=>'required',
              'fonction'=>'required',
              'user_id'=>'required|exists:users,id',
              'user_requested'=>'required|exists:users,id',
              'date_proposition'=>'date',
              'piece'=>'required',
              'status'=>'integer'
        ];

      
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
