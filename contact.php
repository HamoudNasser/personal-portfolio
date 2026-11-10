
<?php


/* CSRF */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}







require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php#contact");
    exit;
}



/* CSRF */

$csrf_token = $_POST['csrf_token'] ?? '';

if (
    !is_string($csrf_token) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $csrf_token)
) {
    http_response_code(403);
    exit("Invalid request. Please refresh the page and try again.");
}







/* Honeypot Protection */

$contact_fax = $_POST['contact_fax'] ?? '';

if (!is_string($contact_fax) || trim($contact_fax) !== '') {
    header("Location: index.php#contact");
    exit;
}










/* Rate Limiting */

 
$now = time();

if (
    isset($_SESSION['last_message_time']) &&
    ($now - $_SESSION['last_message_time']) < 60
) {
   
header("Location: index.php?contact=limited#contact");
exit;

}




$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

if (
    $name === "" ||
    $email === "" ||
    $subject === "" ||
    $message === ""
) {
    exit("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

if (
    strlen($name) > 100 ||
    strlen($email) > 150 ||
    strlen($subject) > 200 ||
    strlen($message) > 5000
) {
    exit("One or more fields are too long.");
}

$sql = "INSERT INTO messages (name, email, subject, message)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $name, $email, $subject, $message);


if ($stmt->execute()) {

    $_SESSION['last_message_time'] = time();

    header("Location: index.php?contact=success#contact");
    exit;
}


http_response_code(500);
exit("Unable to save your message.");

?>
