<?php
namespace Yuga\Validate;
use Closure;
class Validator
{
    protected $db;
    protected $items;
    protected $errorHandler;
    protected $rules = [
        'required',
        'minLength',
        'maxLength',
        'email',
        'alnum',
        'matches',
        'unique',
    ];

    public $messages = [
        'required' => 'The {field} field is required!',
        'minLength' => 'The {field} field must be a minimum of {satisfy} characters',
        'maxLength' => 'The {field} field must be a maximum of {satisfy} characters',
        'email' => 'That is not a valid email address',
        'alnum' => 'The {field} field must contain letters and numbers only',
        'matches' => 'The {field} field must match {satisfy} field',
        'unique' => 'The {field} already exists',
    ];

    public $fieldMessages = [];
    public $customRules = [];
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function check($items, $rules)
    {
        $this->items = $items;
        foreach ($items as $item => $value) {
            if (in_array($item, array_keys($rules))) {
                $this->validate([
                    'field' => $item,
                    'value' => $value,
                    'rules' => $rules[$item]
                ]);
            }
        }

        return $this;
    }

    public function failed()
    {
        return $this->errorHandler->hasErrors();
    }

    public function passed()
    {
        return !$this->failed();
    }

    public function errors()
    {
        return $this->errorHandler;
    }

    public function addRuleMessage($rule, $message)
    {
        $this->messages[$rule] = $message;
    }

    public function addFieldMessage($field, $rule, $message)
    {
        $this->fieldMessages[$field][$rule] = $message;
    }

    public function addRule($rule, Closure $callback)
    {
        $this->customRules[$rule] = $callback;
    }

    protected function getRuleToCall($rule)
    {
        if (isset($this->customRules[$rule])) {
            return $this->customRules[$rule];
        }

        if (method_exists($this, $rule)) {
            return [$this, $rule];
        }
    }

    protected function validate(array $item)
    {
        $field = $item['field'];
        
        foreach ($item['rules'] as $rule => $satisfy) {
            //if (in_array($rule, $this->rules)) {
                //if (!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfy])) {
                if (!call_user_func_array($this->getRuleToCall($rule), [$field, $item['value'], $satisfy])) {
                    $this->errorHandler->addError(
                        $this->message($field, $satisfy, $rule),
                        $field
                    );
                }
            //}
        }
    }

    protected function message($field, $satisfy, $rule)
    {
        $message = str_replace(['{field}', '{satisfy}'], [$field, $satisfy], $this->messages[$rule]);
        if (isset($this->fieldMessages[$field])) {
            if (strstr($message, $field) && isset($this->fieldMessages[$field][$rule])) {
                $message = $this->fieldMessages[$field][$rule];
            }
        }

        return $message;
    }

    protected function required($field, $value, $satisfy)
    {
        return !empty(trim($value));
    }

    protected function maxLength($field, $value, $satisfy)
    {
        return mb_strlen($value) <= $satisfy;
    }

    protected function minLength($field, $value, $satisfy)
    {
        return mb_strlen($value) >= $satisfy;
    }

    protected function email($field, $value, $satisfy)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function alnum($field, $value, $satisfy)
    {
        return ctype_alnum($value);
    }

    protected function matches($field, $value, $satisfy)
    {
        return $value === $this->items[$satisfy];
    }

    protected function unique($field, $value, $satisfy)
    {
        return !\DB::table($satisfy)->where($field, $value)->first();
    }
}