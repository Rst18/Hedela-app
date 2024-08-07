<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSondageRequest extends FormRequest
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
            'reunion_id'=>'required|exists:reunions,id',
            'description'=>'string|max:255',
            'user_id'=>'required|exists:users,id'
        ];
    }

    public function PrepareForValidation(){

        $this->mergeIfMissing([

            'user_id'=>Auth::user()->id
        ]);
    }
}
