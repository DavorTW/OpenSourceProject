<?php
function insertData() {
    // Import credentials
    require 'database.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $rating = $_POST['age-rating'];
        $release_year = $_POST['release-year'];
        $synopsis = $_POST['synopsis'];
        $duration = $_POST['duration'];

        // Handle image upload
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/"; // Use absolute path
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) { // 5000KB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert movie data into database
                $stmt = $db->prepare("INSERT INTO movies (title, year, synopsis, duration, rating, imagePath) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssiss", $title, $release_year, $synopsis, $duration, $rating, $target_file);

                if ($stmt->execute()) {
                    // Retrieve the last inserted movie ID
                    $movie_id = $db->insert_id;

                    // Parse and insert genres
                    $genres_array = explode(",", $genre); // Split genres by comma
                    foreach ($genres_array as $genre_name) {
                        // Trim whitespace from genre name
                        $genre_name = trim($genre_name);

                        // Insert genre into genres table
                        $stmt_genre = $db->prepare("INSERT INTO genres (movieId, genre) VALUES (?, ?)");
                        $stmt_genre->bind_param("is", $movie_id, $genre_name);
                        $stmt_genre->execute();
                        $stmt_genre->close();
                    }
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        mysqli_close($db);
    }
}

insertData();
?>
