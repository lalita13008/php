<?php
function connect() {
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'test_php');

    global $db_conn;
    $db_conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_error());
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

function addUser($username, $password, $role) {
    connect();
    $q = "INSERT INTO users VALUES ('','$username', '$password' , '$role')";
    query_db($q);
    disconnect();
    return true;
}

function select() {
    connect();
    global $db_conn;
    $a = "select * from users";
    $result = mysqli_query($db_conn, $a);
    if ($result === false) {
        throw new Exception(mysqli_error($db_conn));
    }
    disconnect();

    return $result;
}

function editUser($id, $newvalue, $column) {
    connect();
    $q = "Update users Set $column = '$newvalue' Where user_id = $id";
    query_db($q);
    disconnect();

    return true;
}

function deleteUser($column, $value) {
    connect();
    $q = "DELETE FROM users WHERE $column = '$value'";
    query_db($q);
    disconnect();

    return true;
}

try {
    if (deleteUser('role', 'wow')) {
        echo "added!!";
    }
} catch (Exception $e) {
    echo "Mysql error: " . $e->getMessage();
}



$result = select();
echo "<table border='1'>
<tr>
<th>id</th>
<th>username</th>
<th>lastname</th>
<th>role</th>

</tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['passsword'] . "</td>";
    echo "<td>" . $row['role'] . "</td>";
    echo "</tr>";
}
echo "</table>";
