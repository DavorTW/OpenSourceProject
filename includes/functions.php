<?php

function obtenerServicios(){
    try {
        //there are 5 steps to consult a db
        //1- import credentials
        require 'database.php';

        //2- write sql query
        $sql = "SELECT * FROM servicios;";

        //3-do the query
        $query = mysqli_query($db, $sql);

        return $query;

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


obtenerServicios();