<?php
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
