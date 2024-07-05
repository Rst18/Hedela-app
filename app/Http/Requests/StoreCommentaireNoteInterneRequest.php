<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireNoteInterneRequest extends FormRequest
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
            'user_id'=>'exists:users,id|integer|required',
            'note_technique_interne_id'=>'exists:note_technique_internes,id|integer',
            'commentaire'=>'string|required',
            'commentaireParent'=>'integer'
        ];
    }

    public function PrepareForValidation(){
        
        $this->mergeIfMissing([
            
            'user_id'=>Auth::user()->id
        ]);
    }
}
