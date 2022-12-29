<?php

class User
{
    public function __construct(
        public string $email,
        public string $username,
        public string $password,
        public string $password2,
    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if ($this->email === '' || $this->username === '') {
            $isValid = false;
        }

        if ($this->password === '' || $this->password !== $this->password2) {
            $isValid = false;
        }

        return $isValid;
    }
}
