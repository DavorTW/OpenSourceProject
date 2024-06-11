<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the movie ID from the POST request
    if (isset($_POST['movieId'])) {
        $movieId = intval($_POST['movieId']);

        try {
            // Import credentials
            require '../includes/database.php';

            // Start a transaction
            mysqli_begin_transaction($db);

            // Write SQL query to delete related genres
            $queryGenres = "DELETE FROM genres WHERE movieId = ?";

            // Prepare and execute statement for deleting genres
            if ($stmtGenres = mysqli_prepare($db, $queryGenres)) {
                mysqli_stmt_bind_param($stmtGenres, 'i', $movieId);
                mysqli_stmt_execute($stmtGenres);
                mysqli_stmt_close($stmtGenres);
            } else {
                throw new Exception("Failed to delete genres");
            }

            // Write SQL query to delete the movie
            $queryMovie = "DELETE FROM movies WHERE movieId = ?";

            // Prepare and execute statement for deleting the movie
            if ($stmtMovie = mysqli_prepare($db, $queryMovie)) {
                mysqli_stmt_bind_param($stmtMovie, 'i', $movieId);
                mysqli_stmt_execute($stmtMovie);
                mysqli_stmt_close($stmtMovie);
            } else {
                throw new Exception("Failed to delete movie");
            }

            // Commit the transaction
            mysqli_commit($db);

            // Close the connection
            mysqli_close($db);

            // Redirect to the main page or confirmation page
            header("Location: ../index.php?message=Movie+deleted+successfully");
            exit;
        } catch (Throwable $th) {
            // Rollback the transaction on error
            mysqli_rollback($db);
            var_dump($th);
        }
    } else {
        echo "No movie ID provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
