<?php
// Database connection settings – update these values with your own database credentials.
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "bookdb";

// Create a connection.
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted using POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Escape and retrieve form inputs.
    $title       = $conn->real_escape_string($_POST["title"]);
    $price       = $conn->real_escape_string($_POST["price"]);
    $stock       = $conn->real_escape_string($_POST["stock"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $category    = $conn->real_escape_string($_POST["category"]);

    // Process the image upload.
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Allowed file extensions and MIME types.
        $allowed = [
            "jpg"  => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png"  => "image/png",
            "gif"  => "image/gif"
        ];

        $filename  = $_FILES["image"]["name"];
        $filetype  = $_FILES["image"]["type"];
        $filesize  = $_FILES["image"]["size"];
        $fileExt   = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Verify file extension.
        if (!array_key_exists($fileExt, $allowed)) {
            echo "Error: Please select a valid file format.";
            exit;
        }

        // Verify file size - 5MB maximum.
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            echo "Error: File size is larger than the allowed limit (5MB).";
            exit;
        }

        // Verify MIME type.
        if (in_array($filetype, $allowed)) {
            // Set the target directory for uploads.
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            // Generate a unique name for the file.
            $newFilename = uniqid() . "." . $fileExt;
            $target_file = $target_dir . $newFilename;

            // Attempt to move the uploaded file.
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
                exit;
            }
        } else {
            echo "Error: There was a problem with your upload. Please try again.";
            exit;
        }
    } else {
        echo "Error: " . $_FILES["image"]["error"];
        exit;
    }

    // Prepare an SQL statement to insert the book into the 'books' table.
    $sql = "INSERT INTO books (title, price, stock, description, category, image) 
            VALUES ('$title', '$price', '$stock', '$description', '$category', '$image_path')";

    // Execute the query and check if it was successful.
    if ($conn->query($sql) === TRUE) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection.
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
