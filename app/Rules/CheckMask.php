<?php

namespace App\Rules;

use App\Models\EquipmentType;
use Illuminate\Contracts\Validation\Rule;

class CheckMask implements Rule
{
    public $equipment_type_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($equipment_type_id)
    {
        $this->equipment_type_id = $equipment_type_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = false;
        $type = EquipmentType::find($this->equipment_type_id);
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
        $pattern = "/^".$pattern."$/";
        return $pattern;
    }
}
