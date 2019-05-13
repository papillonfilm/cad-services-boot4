<?php
/**
 * Created by PhpStorm.
 * User: KBlanck
 * Date: 3/25/2019
 * Time: 12:25 PM
 */

namespace App\Applications\cadWebSupport\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateUserForDelete implements Rule
{
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($value1, $value2, $field, $test)
    {
        $this->value1 = $value1;
        $this->value2 = $value2;
        $this->field = $field;
        $this->test = $test;
        $this->message = "Must enter User Id, Bar Num or Email.";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value) && empty($this->value1) && empty($this->value2)) {
            return false;
        }

        //dd($this->test);
        if (!empty($value) && !empty($this->test)) {
            switch ($this->test) {
                case 'numeric':
                    if (!is_numeric($value) || $value < 0) {
                        $this->message = $this->field." must be ".$this->test;
                        return false;
                    }
                    break;
                //default:

            }

        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
