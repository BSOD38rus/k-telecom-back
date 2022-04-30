<?php

namespace App\Http\Requests\Equipment;

use App\Rules\CheckMask;
use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
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
        # В правилах изменение будут только в серийнике, поэтому возьмем правила из StoreRequest и заменим его
        $rules = array_merge(parent::rules(), [
            'serial.*' => [
                'required',
                Rule::unique('equipments', 'serial')->ignore($this->id),
                new CheckMask($this->equipment_type_id)
            ]
        ]);
        return $rules;
    }
}
