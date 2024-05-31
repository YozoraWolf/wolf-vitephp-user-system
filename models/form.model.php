<?php

class LoginErrors {
    const NONE = 'none';
    const EMP = 'empty';
    const EMAIL_INVALID = 'email_invalid';
    const EMAIL_NOT_FOUND = 'email_not_found';
    const PASSWORD_INVALID = 'password_invalid';
}

$login_msgs = [
    LoginErrors::NONE => 'none',
    LoginErrors::EMP => 'Please fill in all fields',
    LoginErrors::EMAIL_INVALID => 'Invalid e-mail format',
    LoginErrors::EMAIL_NOT_FOUND => 'E-mail not found in DB',
    LoginErrors::PASSWORD_INVALID => 'Invalid e-mail or password'
];

class FormData {
    public $username = "";
    public $email = "";
    public $password = "";
    public $password_repeat = "";
    
    public function __construct($username, $email, $password, $password_repeat) {
        // All fields are sanitized in case it contains malicious code
        $this->username = $this->sanitize($username);
        $this->email = $this->sanitize($email);
        $this->password = $this->sanitize($password);
        $this->password_repeat = $this->sanitize($password_repeat);
    }
    
    private function sanitize($value) {
        // Reserved in case I need to do additional sanitization
        return htmlspecialchars($value);
    }
}
?>
