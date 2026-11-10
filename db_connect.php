

<?php

$config_path = dirname(__DIR__, 2) . "/portfolio_private/db_config.php";

if (!is_file($config_path)) {
    error_log("Database configuration file is missing.");
    http_response_code(503);
    exit("Service temporarily unavailable.");
}

$config = require $config_path;

try {

    $conn = new mysqli(
        $config["host"],
        $config["username"],
        $config["password"],
        $config["database"]
    );

    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {

    error_log("Database connection error: " . $e->getMessage());

    http_response_code(503);

    exit("Service temporarily unavailable.");
}
