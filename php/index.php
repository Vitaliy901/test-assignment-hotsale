<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Header: *');
header('Content-Type: application/json; charset=utf-8');

// users
$users = [
    [
        'id' => 1,
        'email' => 'Stephen@mail.com',
        'first_name' => 'Stephen',
        'last_name' => 'Duran',
        'password' => password_hash("firstpassword", PASSWORD_DEFAULT)
    ],
    [
        'id' => 2,
        'email' => 'Salman@mail.com',
        'first_name' => 'Salman',
        'last_name' => 'Boone',
        'password' => password_hash("secondpassword", PASSWORD_DEFAULT)
    ]
];


if (isData()) {
    $formData = array_map('inputs_filter', $_REQUEST);

    $isValid = isset($formData['password']) &&
        isset($formData['confirmation_password']) &&
        isset($formData['email']);


    $errorMessage = match ($isValid) {
        $formData['password'] !== $formData['confirmation_password'] => 'The password does not match!',
        isExists($users, $formData['email']) => 'Mail already exists!',
        !preg_match('#@#', $formData['email']) => 'Invalid mail format!',
        default => '',
    };

    if (empty($errorMessage)) {
        array_push($users, $formData);
        writeLogs($formData['email']);
        http_response_code(201);
    } else {
        echo $errorMessage;
        http_response_code(422);
    }
} else {
    http_response_code(204);
}


function isExists(array $data, string $inputEmail): bool
{
    $emails = array_column($data, 'email');
    $emails = array_map(function ($email) {
        return strtolower($email);
    }, $emails);

    return in_array(strtolower($inputEmail), $emails);
}
// filter values
function inputs_filter($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// check for existing data
function isData(): bool
{
    return $_SERVER["REQUEST_METHOD"] == "POST" && !in_array("", $_REQUEST);
}

// Write logs
function writeLogs(string $email)
{
    $file = './logs/php.log';

    $current .= date('Y.m.d H:i', time()) . ' - ' . 'User successfully created: ' . $email . PHP_EOL;

    file_put_contents($file, $current, FILE_APPEND);
}
