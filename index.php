<?php
require_once 'includes/include.php';

ORMFacade::selectUser(['id'=>2,'name' => 'ali']); //user | users
//ORMFacade::seslectUser(['id'=>2,'name' => 'ali']); //user | users
//ORMFacade::addUser(['id'=>1,'name' => 'ali']); //user | users
//ORMFacade::createProduct(['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com']);
/*
$user = ORMFacade::findProduct(['id' => 2]);
if ($user) {
    echo "Found user: " . $user['name'] . "\n";
} else {
    echo "User not found.\n";
}*/
/*
ORMFacade::updateUser(['id' => 2, 'name' => 'Jane Johnson']);
$user = ORMFacade::findUser(['id' => 2]);
if ($user) {
    echo "Updated user name: " . $user['name'] . "\n";
} else {
    echo "User not found.\n";
}
*/
/*
ORMFacade::deleteUser(['id' => 1]);
$user = ORMFacade::findUser(['id' => 1]);
if ($user) {
    echo "Found user: " . $user['name'] . "\n";
} else {
    echo "User not found.\n";
}*/
