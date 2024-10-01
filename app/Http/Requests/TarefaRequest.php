<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use function Laravel\Prompts\error;

class TarefaRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'concluida' => 'required|boolean',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'sucess' => false,
            'errors'=> $validator->errors()
        ],422));
    }

    public function messages()
    {
        return[
            'titulo.requires' => 'o titulo da tarefa é obrigatório',
            'titulo.max' => 'o titulo da tarefa deve conter no máximo 255 caracteres'
        ];
    }
}
