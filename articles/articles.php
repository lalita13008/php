<?php

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'add' :
            addArticle($_POST['title'], $_POST['detail']);
            break;
        case 'show_by_id' :
            selectByid($_POST['id']);
            break;
        case 'show' :
            select();
            break;
        case 'add_comment' :
            addComment($_POST['comment'], $_POST['id']);
            break;
    }
}

function connect() {
    require_once('../common/config.php');

    global $db_conn;
    $db_conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_error());
    mysqli_set_charset($db_conn, "utf8");
}

function disconnect() {
    global $db_conn;
    mysqli_close($db_conn);
}

function query_db($query) {
    global $db_conn;
    if (mysqli_query($db_conn, $query) === false) {
        throw new Exception(mysqli_error($db_conn));
    } else {
        return true;
    }
}

function addArticle($title, $detail) {
    connect();
    global $db_conn;
    $last_id = "";
    $q = "INSERT INTO articles VALUES (NULL,'$title', '$detail',CURRENT_TIMESTAMP)";
    if (mysqli_query($db_conn, $q)) {
        $last_id = mysqli_insert_id($db_conn);
        echo $last_id;
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($db_conn);
    }

    disconnect();
}

function editArticle($id, $newvalue, $column) {
    connect();
    $q = "Update articles set $column = '$newvalue' Where article_id = $id";
    query_db($q);
    disconnect();
    return true;
}

function select() {
    connect();
    global $db_conn;
    $a = "select * from articles";
    $result = mysqli_query($db_conn, $a);
    if ($result === false) {
        throw new Exception(mysqli_error($db_conn));
    }
    while ($row = mysqli_fetch_assoc($result))
        $test[] = $row;
    disconnect();
    echo json_encode($test);
}

function selectByid($id) {
    connect();
    global $db_conn;
    $a = "select * from articles where article_id = '$id'";
    $result = mysqli_query($db_conn, $a);
    if ($result === false) {
        throw new Exception(mysqli_error($db_conn));
    }
    while ($row = mysqli_fetch_assoc($result))
        $test[] = $row;
    disconnect();
    echo json_encode($test);
}

function deleteUser($column, $value) {
    connect();
    $q = "DELETE FROM articles WHERE $column = '$value'";
    query_db($q);
    disconnect();

    return true;
}

function addComment($comment, $article_id) {
    connect();
    global $db_conn;
    $last_id = "";
    $q = "INSERT INTO comments VALUES (NULL,'$comment', CURRENT_TIMESTAMP, '$article_id')";
    if (mysqli_query($db_conn, $q)) {
        $last_id = mysqli_insert_id($db_conn);
        echo $last_id;
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($db_conn);
    }

    disconnect();
}

//try {
//    if (addArticle('li-hong kaka', 'อีกดวก')) {
//        echo "added!!";
//    }
//} catch (Exception $e) {
//    echo "Mysql error: " . $e->getMessage();
//}


//$result = select();
//print_r($result);
