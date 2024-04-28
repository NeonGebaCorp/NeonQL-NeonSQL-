<?php

// ****************************************************************************
// Authentication function that checks if the provided password matches the  *
// saved password in the file 'pass.txt'. The password is hashed using the   *
// SHA-256 algorithm before comparison.                                       *
// ****************************************************************************
function isPasswordValid($password) {
    $savedPassword = trim(file_get_contents("pass.txt"));
    return $password === hash('sha2
