<?php

function getMovie(){
    try {
        //there are 5 steps to consult a db
        //1- import credentials
        require 'database.php';

        //2- write sql query
        $query = "SELECT * FROM movies;";

        //3-do the query
        $result = mysqli_query($db, $query);

        return $result;

        //4-access to the results

        // echo "<pre>";
        // var_dump(mysqli_fetch_assoc($query));
        // echo "</pre>";
        
        //5-close the conection (optional)
        mysqli_close($db);
    } catch (\Throwable $th) {
        var_dump($th);
    }
}


getMovie();