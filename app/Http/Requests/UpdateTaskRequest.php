<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'nom'=>'required|string|max:255',
            'description'=>'required|string',
            'statut'=>'integer',
            'priorite'=>'integer',
            'statut_resolution'=>'integer',
            // 'date_limite'=>'date',
            'date_debut'=>'required|date',
            'date_fin'=>'required|date',
            'date_fermeture'=>'required|date',
            'user_id'=>'required|exists:users,id'
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
