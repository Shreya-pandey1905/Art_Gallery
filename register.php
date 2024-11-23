<?php
// Step 1: Database Connection
$servername = "localhost"; // Replace with your database host if different
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "art_gallery_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handling Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $full_name = $conn->real_escape_string(trim($_POST['fullName']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password']; // Do not trim passwords; spaces may be intentional
    $confirmPassword = $_POST['confirmPassword'];

    // Step 3: Validate Password Confirmation
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit(); 
    }

    // Step 4: Password Hashing for Security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Step 5: Check if Email Already Exists
    $email_check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($email_check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists. Please try a different one.";
    } else {
        // Step 6: Insert Data into Database using Prepared Statements
        $sql = "INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $full_name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful! You can now log in.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
