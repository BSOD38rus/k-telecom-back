<?php

namespace App\Rules;

use App\Models\EquipmentType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class CheckMask implements Rule, DataAwareRule
{
    public $massStore;


    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(bool $massStore)
    {
        $this->massStore = $massStore;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function passes($attribute, $value)
    {
        $result = false;
        $equipment_type_id = '';
        # Проверяем на массовое заполнение
        if ($this->massStore) {
            # ничего лучше не предумал как вытащить ключ итерации... Костыль, но рабочий
            $key = explode('.', $attribute);
            $key = $key[0];
            $equipment_type_id = $this->data[$key]['equipment_type_id'];
        }
        else $equipment_type_id = $this->data['equipment_type_id'];

        $type = EquipmentType::find($equipment_type_id);
        if ($type !== null) {
            $pattern = $this->createMask($type->mask);
            $result = preg_match($pattern, $value);
            #dd($pattern);
        }
        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute does not match the template.';
    }

    private function createMask($mask)
    {
        $trans = array(
            'N' => "[0-9]",
            'A' => "[A-Z]",
            'a' => "[a-z]",
            'X' => "[A-Z0-9]",
            'Z' => "[-_@]"
        );

        $pattern = strtr($mask, $trans);
        $pattern = "/^" . $pattern . "$/";
        return $pattern;
    }
}
