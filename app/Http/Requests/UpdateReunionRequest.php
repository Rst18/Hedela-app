<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReunionRequest extends FormRequest
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
           'id'=>'required|string|exists:reunions,id',
            'description'=>'required|string',
            'lien_zoom'=>'string',
            'lien_youtube'=>'string',
            'date_debut'=>'required|date',
            'date_fin'=>'required|date',
            'status'=>'boolean',
            'type_reunion_id'=>'required|exists:type_reunions,id'
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
