<?php
include './config/db.php';

// Get all games
function getAll() {
    global $con;
    return $con->query("SELECT * FROM game ORDER BY gameId DESC");
}

// Get one game by ID
function getOne($id){
    global $con;
    $result = $con->query("SELECT * FROM game WHERE gameId='$id'");
    return $result->fetch_assoc();
}

// Insert new game
function createGame($name, $price, $image){
    global $con;
    $sql = "INSERT INTO game (gameName, gamePrice, gameImage) VALUES ('$name', '$price', '$image')";
    return $con->query($sql);
}

// Update game
function updateGame($id, $name, $price, $image=''){
    global $con;
    if($image){
        $sql = "UPDATE game SET gameName='$name', gamePrice='$price', gameImage='$image' WHERE gameId='$id'";
    } else {
        $sql = "UPDATE game SET gameName='$name', gamePrice='$price' WHERE gameId='$id'";
    }
    return $con->query($sql);
}

// Delete game
function deleteGame($id){
    global $con;
    return $con->query("DELETE FROM game WHERE gameId='$id'");
}
?>
