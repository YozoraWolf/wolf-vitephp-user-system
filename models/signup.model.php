<?php
class FormData {
    public string $username;
    public string $email;
    public string $password;
    public string $password_repeat;
    
    public function __construct(string $username, string $email, string $password, string $password_repeat) {
        // All fields are sanitized in case it contains malicious code
        $this->username = $this->sanitize($username);
        $this->email = $this->sanitize($email);
        $this->password = $this->sanitize($password);
        $this->password_repeat = $this->sanitize($password_repeat);
    }
    
    private function sanitize(string $value): string {
        // Reserved in case I need to do additional sanitization
        return htmlspecialchars($value);
    }
}
?>
