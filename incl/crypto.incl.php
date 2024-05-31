<?php
// encrypt password
function bcrypt_hash($password) {
    $cost = 10;
    // generate a random salt
    $salt = strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+', '.');
    // salt should be 22 characters in length
    $salt = sprintf("$2y$%02d$", $cost) . $salt;
    // hash the password with the salt
    $hash = crypt($password, $salt);
    return $hash;
}

// verify hashes (might not be needed)
function bcrypt_verify($password, $hash) {
    return crypt($password, $hash) === $hash;
}
?>