<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteTechniqueInterneRequest extends FormRequest
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
            'status'=>'integer', 
            'faits'=>'required',
            'analyse'=>'required',
            'conclusion'=>'required',
            'actions'=>'required',
            'objet'=>'string',
            'destinataire'=>'string',
            'signataire'=>'string',
            'copiea'=>'string',
            'type_lettre'=>'integer',
            'annexe'=>'integer',
            'lettre'=>'string',
            'user_id'=>'required|exists:users,id',
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
