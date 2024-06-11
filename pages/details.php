<?php

function getMovieById($movieId) {
    try {
        // Import credentials
        require '../includes/database.php';

        // Write SQL query
        $query = "SELECT movies.*, GROUP_CONCAT(genres.genre SEPARATOR ', ') as genres
                  FROM movies
                  LEFT JOIN genres ON movies.movieId = genres.movieId
                  WHERE movies.movieId = ?
                  GROUP BY movies.movieId";

        // Prepare and execute statement
        if ($stmt = mysqli_prepare($db, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $movieId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $movie = mysqli_fetch_assoc($result);

            // Close statement
            mysqli_stmt_close($stmt);

            return $movie;
        } else {
            throw new Exception("Database query failed");
        }

        // Close the connection
        mysqli_close($db);
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

    if (isset($_GET['movieId'])) {
        $movieId = intval($_GET['movieId']);
        $movie = getMovieById($movieId);
    } else {
        echo "No movie selected.";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMovieList</title>
    <link rel ="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,900;1,400;1,500;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>


<body class="container wrapper">
<header class="header">
        <div class="nav">
            <div class="logo">
                <a href="../index.php"><span class="logo-color">MyMovie</span>List</a>
            </div>
        </div>

        <div class="user">
            <div class="user-img">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                  </svg>
            </div>
            <div class="name">
                <p>User name</p>
            </div>
        </div>
    </header>


    <h1 class="movie-title"><?php echo htmlspecialchars($movie['title']); ?></h1>

    <div class="movie-details details-container">
        <img class="card-image" src="../<?php echo $movie['imagePath'];?>" alt="movie-cover">
        <div class="movie-info">
            <p class ="synopsis"> <?php echo $movie['synopsis'];?> </p>
            <div class="buttons">
                <button>Add to favorites</button>
                <button>Add to watched list</button>
                <button>Delete movie</button>
            </div>

        </div>
    </div>

    <footer class="footer section">
        <p>&copy; 2024 All rights reserved.</p>
    </footer>
</body>
</html>