<?php
include './models/pcModel.php';

$action = $_GET['action'] ?? 'list';

// LIST ALL GAMES
if($action == 'list'){
    $game = getAll();
    include './views/main.php';
}

// SHOW CREATE FORM
elseif($action == 'create'){
    include './views/create.php';
}

// STORE DATA
elseif($action == 'store'){
    $name  = $_POST['gameName'];
    $price = $_POST['gamePrice'];

    $imageName = $_FILES['gameImage']['name'];
    $tmpName   = $_FILES['gameImage']['tmp_name'];

    move_uploaded_file($tmpName, "uploads/".$imageName);

    createGame($name, $price, $imageName);

    header("Location: index.php");
    exit;
}

// SHOW EDIT FORM
elseif($action == 'edit'){
    $id = $_GET['id'] ?? null;
    if(!$id){
        header("Location: index.php");
        exit;
    }
    $gameData = getOne($id);
    if(!$gameData){
        echo "<h3 class='text-white text-center mt-5'>Game not found.</h3>";
        exit;
    }
    include './views/edit.php';
}

// UPDATE GAME
elseif($action == 'update'){
    $id    = $_GET['id'];
    $name  = $_POST['gameName'];
    $price = $_POST['gamePrice'];

    $oldGame = getOne($id); 

    if(isset($_FILES['gameImage']) && $_FILES['gameImage']['name'] != ''){
        $imageName = $_FILES['gameImage']['name'];
        $tmpName   = $_FILES['gameImage']['tmp_name'];

        move_uploaded_file($tmpName, "uploads/".$imageName);

        if($oldGame['gameImage'] && $oldGame['gameImage'] != 'default.png' && file_exists("uploads/".$oldGame['gameImage'])){
            unlink("uploads/".$oldGame['gameImage']);
        }

        updateGame($id, $name, $price, $imageName);
    } else {
        updateGame($id, $name, $price);
    }

    header("Location: index.php");
    exit;
}

// DELETE GAME
elseif($action == 'delete'){
    $id = $_GET['id'] ?? null;
    if($id){
        $gameToDelete = getOne($id);
        if($gameToDelete['gameImage'] && $gameToDelete['gameImage'] != 'default.png' && file_exists("uploads/".$gameToDelete['gameImage'])){
            unlink("uploads/".$gameToDelete['gameImage']); 
        }
        deleteGame($id);
    }
    header("Location: index.php");
    exit;
}
?>
