<?php

function getPosts($pdo){
    $query = "SELECT * FROM `posts`";
    $result = $pdo->prepare($query);
    $result->execute();

    $all_posts = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($all_posts);
}

function getPost($pdo, $id){
    $query = "SELECT * FROM `posts` WHERE `id` = :id";
    $result = $pdo->prepare($query);
    $result->execute(['id' => $id]);

    if ($result->rowCount() === 1){
        $single_post = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode($single_post);
    } else {
        http_response_code(404);
        echo json_encode([
            'status' => false,
            'message' => 'Запись не была найдена.'
        ]);
    }
}

function addPost($pdo, $data){
    $query = "INSERT INTO `posts` (`title`, `body`) VALUES (:title, :body)";
    $result = $pdo->prepare($query);
    $result->execute($data);

    http_response_code(201);
    echo json_encode([
        'status' => true,
        'new_id' => $pdo->lastInsertId()
    ]);
}

function UpdatePost($pdo, $id, $data) {
    $query = "UPDATE `posts` SET `title` = :title, `body` = :body WHERE `id` = :id";
    $result = $pdo->prepare($query);
    $result->execute([
        'title' => $data['title'],
        'body' => $data['body'],
        'id' => $id
    ]);

    echo json_encode([
        'status' => true,
        'message' => 'Данные обновлены'
    ]);
}