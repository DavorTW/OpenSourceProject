<?php
    require 'includes/getMovie.php';
    $result = getMovie();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMovieList</title>
    <link rel ="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,900;1,400;1,500;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="container wrapper">
    <header class="header">
        <div class="nav">
            <div class="logo">
                <a href="index.php"><span class="logo-color">MyMovie</span>List</a>
            </div>

            <nav class="nav-content">
                <a href="#">Watched</a>
                <a href="#">Pending</a>
                <a href="#">Favorites</a>
            </nav>
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


    <main class="main">
        <h1 class="main-title">My Movies</h1>

        <a class="add-movie" href="pages/addmovie.php">Add Movie</a>
    </main>

    <div class="bar">
        <div class="genres">
            <a class="genre" href="#All">All</a>
            <a class="genre" href="#Action">Action</a>
            <a class="genre" href="#Animation">Animation</a>
            <a class="genre" href="#Comedy">Comedy</a>
            <a class="genre" href="#Drama">Drama</a>
            <a class="genre" href="#Horror">Horror</a>
            <a class="genre" href="#Mystery">Mystery</a>
            <a class="genre" href="#Thriller">Thriller</a>
        </div>

        <div class="search-bar">
            <input class="input-field" type="text" placeholder="Search...">

            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
        </div>
    </div>
    
    <div class="catalog-container">
        <div class="grid-container">
        <?php while($movie = mysqli_fetch_assoc($result)) { ?>
        <div class='movie-card'>
            <img src="<?php echo $movie['imagePath']; ?>">
            <div class="movie-content">
                <h3><?php echo $movie['title']; ?></h3>
                <p><?php echo $movie['rating']; ?></p>
            </div>
            <ul class="tag">
                <li class="tag-item"></li>
                <li class="tag-item"><?php echo $movie['duration']; ?> min</li>
                <li class="tag-item"><?php echo $movie['year']; ?></li>
            </ul>
        </div>
        <?php } ?>

            <!-- <div class="movie-card">
                <img src="source/images.jfif" alt="Movie 1">
                <div class="movie-content">
                    <h3>Interstellar</h3>
                    <p>PG-13</p>
                </div>
                <ul class="tag">
                    <li class="tag-item">Comedy</li>
                    <li class="tag-item">2h</li>
                    <li class="tag-item">2015</li>
                </ul>
            </div>   -->
            <!-- Add more movie cards as needed -->
        </div>
    </div>


    

    <footer class="footer section">
        <p>&copy; 2024 All rights reserved.</p>
    </footer>

    <script src="js/modernizr.js"></script>
</body>
</html>