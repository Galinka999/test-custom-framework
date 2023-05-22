<?php

declare(strict_types=1);

namespace App\Http\Validations;

final class ItemUpdateValidator
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        foreach ($this->data as $key => $value) {
            $method = 'validate'.ucfirst($key);
            $this->{$method}();
        }
    }

    public function validate()
    {
        $this->validateName();
        $this->validatePhone();
        $this->validateKey();
    }

    private function validateName()
    {
        $name = $this->data['name'];
        if(is_numeric($name) || is_bool($name) || is_array($name)) {
            $this->echoError('Name must be string');
        }
        if(is_string($name) && !preg_match('/^[a-zA-Z0-9]{1,255}$/', $name)) {
            $this->echoError('Name is not valid');
        }
    }

    private function validatePhone()
    {
        $phone = $this->data['phone'];

        if(is_bool($phone) || is_array($phone)) {
            $this->echoError('Phone must be string');
        }

        if(is_string($phone) && !preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)) {
            $this->echoError('Phone is not valid');
        }
    }

    private function validateKey()
    {
        $key = $this->data['key'];
        if(is_string($key) && !preg_match('/^[a-zA-Z0-9]{1,15}$/', $key)) {
            $this->echoError('Key is not valid');
        }
    }

    private function echoError(string $value)
    {
        echo json_encode([
            'status' => 'error',
            'message' => $value
        ]);
        die();
    }

}