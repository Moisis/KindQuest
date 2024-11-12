<?php

// $conn = new mysqli($configs->DB_HOST, $configs->DB_USER, $configs->DB_PASS, $configs->DB_NAME);


class DatabaseManager{
    private static $instance;
    private $conn;

    private function __construct(){
        $configs = require __DIR__."/../config/config.php";
        $this->conn = new mysqli($configs->DB_HOST, $configs->DB_USER, $configs->DB_PASS, $configs->DB_NAME);
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new DatabaseManager();
        }
        return self::$instance;
    }

    public function get_connection(){
        return $this->conn;
    }
}

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// echo "Connected successfully<br/><hr/>";

function run_queries($queries, $echo = false): array
{
    // global $conn;
    $conn = DatabaseManager::getInstance()->get_connection();
    $ret = [];
    foreach ($queries as $query) {
        $ret += [$conn->query($query)];
        if ($echo) {
            echo '<pre>' . $query . '</pre>';
            echo $ret[array_key_last($ret)] === TRUE ? "Query ran successfully<br/>" : "Error: " . $conn->error;
            echo "<hr/>";
        }
    }
    return $ret;
}

function run_query($query, $echo = false): bool
{
    return run_queries([$query], $echo)[0];
}

function run_select_query($query, $params = [], $echo = false): mysqli_result|bool
{
    $conn = DatabaseManager::getInstance()->get_connection();

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        if ($echo) echo "Error preparing query: " . $conn->error . "<br><hr/>";
        return false;
    }

    // Bind parameters if provided
    if ($params) {
        $types = str_repeat("s", count($params));
        $stmt->bind_param($types, ...$params);
    }

    // Execute and retrieve result
    $stmt->execute();
    $result = $stmt->get_result();

    if ($echo) {
        echo '<pre>' . $query . '</pre>';
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $columnName => $columnData) {
                    echo "$columnName: $columnData<br>";
                }
                echo "<br><br>";
            }
        } else {
            echo "0 results or error: " . $conn->error . "<br>";
        }
        echo "<hr/>";
    }

    $stmt->close();
    return $result;
}


function run_insert_query($query, $params = [], $echo = false): bool
{
    $conn = DatabaseManager::getInstance()->get_connection();

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        if ($echo) echo "Error preparing query: " . $conn->error . "<br><hr/>";
        return false;
    }

    // Bind parameters if provided
    if ($params) {
        $types = str_repeat("s", count($params));  // Adjust types as needed
        $stmt->bind_param($types, ...$params);
    }

    // Execute and check result
    $success = $stmt->execute();

    if ($echo) {
        echo '<pre>' . $query . '</pre>';
        echo $success ? "Insert successful<br>" : "Error: " . $conn->error . "<br>";
        echo "<hr/>";
    }

    // Clean up and return
    $stmt->close();
    return $success;
}

function run_update_query($query, $params = [], $echo = false): bool
{
    $conn = DatabaseManager::getInstance()->get_connection();

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        if ($echo) echo "Error preparing query: " . $conn->error . "<br><hr/>";
        return false;
    }

    // Bind parameters if provided
    if ($params) {
        $types = str_repeat("s", count($params));  // Adjust types as needed
        $stmt->bind_param($types, ...$params);
    }

    // Execute and check result
    $success = $stmt->execute();

    if ($echo) {
        echo '<pre>' . $query . '</pre>';
        echo $success ? "Update successful<br>" : "Error: " . $conn->error . "<br>";
        echo "<hr/>";
    }

    // Clean up and return
    $stmt->close();
    return $success;
}

function run_delete_query($query, $params = [], $echo = false): bool
{
    $conn = DatabaseManager::getInstance()->get_connection();

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        if ($echo) echo "Error preparing query: " . $conn->error . "<br><hr/>";
        return false;
    }

    // Bind parameters if provided
    if ($params) {
        $types = str_repeat("s", count($params));  // Adjust types as needed
        $stmt->bind_param($types, ...$params);
    }

    // Execute and check result
    $success = $stmt->execute();

    if ($echo) {
        echo '<pre>' . $query . '</pre>';
        echo $success ? "Delete successful<br>" : "Error: " . $conn->error . "<br>";
        echo "<hr/>";
    }

    // Clean up and return
    $stmt->close();
    return $success;
}

// $conn->close();
