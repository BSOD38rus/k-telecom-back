<?php

namespace App\Http\Requests\Equipment;

use App\Rules\CheckMask;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        # Проверяем на массовое заполнение по степени вложености ключей
        if (isset($this->serial) or isset($this->equipment_type_id) or isset($this->note)) {
            $rules['equipment_type_id'] = 'required|integer|exists:equipment_types,id';
            $rules['note'] = 'nullable|string|max:255';
            $rules['serial'] = 'required|array';
            $rules['serial.*'] = [
                'required',
                'unique:equipments,serial',
                new CheckMask(false)
            ];
        } else {
            $rules['*.equipment_type_id'] = [
                'required', 'integer', 'exists:equipment_types,id',
            ];
            $rules['*.note'] = 'nullable|string|max:255';
            $rules['*.serial'] = 'required|array';
            $rules['*.serial.*'] = [
                'required',
                'unique:equipments,serial',
                new CheckMask(true),
            ];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422));
    }
}
