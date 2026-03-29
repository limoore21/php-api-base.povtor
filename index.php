<?php
require 'connectDb.php';
require 'functions.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$url_params = explode('/', $_GET['q']);
$type = $url_params[0];

if (isset($url_params[1])) {
    $id = $url_params[1];
}

switch ($method) {
    case 'GET':
        if ($type === 'posts') {
            if (isset($id)) {
                getPost($pdo, $id);
            } else {
                getPosts($pdo);
            }
        }
        break;

    case 'POST':
        if ($type === 'posts') {
            addPost($pdo, $_POST);
        }
        break;

    case 'PATCH':
        if ($type === 'posts' && isset($id)) {
            $input_json = file_get_contents('php://input');
            $decoded_data = json_decode($input_json, true);

            UpdatePost($pdo, $id, $decoded_data);
        }
        break;
}