<?php
require 'db.php';

$query = 'SELECT * FROM `imdb_movie` WHERE `imdb_movie`.`name` LIKE ?';
if($_GET) {
    $name = '%' . $_GET['search'] . '%';
    $stmt = db::query($query, [$name]);
    $data = $stmt->fetchAll();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-5 bg-dark mx-auto mt-5 rounded align-midle">
                <h1 class="text-center text-uppercase text-light mb-5">Sarch you movie</h1>
                <form class="my-2 my-lg-0 mt-5">
                    <input name="search" class="form-control" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-block btn-outline-primary my-2" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-7 mt-5 mx-auto text-center">
                <ul>
                    <?php if($_GET): ?>
                        <?php foreach ($data as $movie) : ?>
                            <li><a href="movie.php?id=<?= $movie['imdb_id']; ?>"><?= $movie['name']; ?> (<?= $movie['year']; ?>)</a></li>
                        <?php endforeach; ?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>