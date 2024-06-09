<?php 
    require '../includes/insertData.php';
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
    <div class="form-container">
        <h2>Add a New Movie</h2>
        <form id="add-movie-form" action="addmovie.php" method="POST" enctype="multipart/form-data">
            <label for="title">Movie Title</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Synopsis</label>
            <textarea id="synopsis" name="synopsis" rows="4" required></textarea>

            <label for="image">Movie Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <img id="image-preview" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-top: 10px;">

            <label for="age-rating">Age Rating</label>
            <input type="text" id="age-rating" name="age-rating" required>

            <label for="genre">Genres (comma separated)</label>
            <input type="text" id="genre" name="genre" required>

            <label for="duration">Duration (minutes)</label>
            <input type="number" id="duration" name="duration" required>

            <label for="release-date">Release Date (Year)</label>
            <input type="number" id="release-year" name="release-year" required>

            <button type="submit">Add Movie</button>
        </form>
    </div>

    <script src="../js/app.js" ></script>

</body>
</html>