<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteTechniqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ 
            
            'status'=>'required', 
            'faits'=>'required',
            'analyse'=>'required',
            'conclusion'=>'required',
            'actions'=>'required',
            'objet'=>'required',
            'destinataire'=>'required',
            'signataire'=>'required',
            'copiea'=>'required',
            'type_lettre'=>'required',
            'annexes'=>'required',
            'lettre'=>'required',
            'user_id'=>'required|exists:users,id',
            'courrier_id'=>'required|exists:courriers,id'
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
