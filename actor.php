<?php
require 'db.php';
$query = 'SELECT * FROM `imdb_movie_has_person`
LEFT JOIN `imdb_person`
ON `imdb_movie_has_person`.`imdb_person_id` = `imdb_person`.`imdb_id`
WHERE `imdb_id` = ?';
$id = $_GET['id'];
$stmt = db::query($query, [$id]);
$actor = $stmt->fetchAll();

$query = 'SELECT * FROM `imdb_movie_has_person`
LEFT JOIN `imdb_person`
ON `imdb_movie_has_person`.`imdb_person_id` = `imdb_person`.`imdb_id`
LEFT JOIN `imdb_position`
ON `imdb_movie_has_person`.`imdb_position_id` = `imdb_position`.`id`
LEFT JOIN `imdb_movie`
ON `imdb_movie_has_person`.`imdb_movie_id` = `imdb_movie`.`imdb_id`
WHERE `imdb_person`.`imdb_id` = ?';
$stmt = db::query($query, [$id]);
$actorAll = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style>
        .scroll {
            max-height: 600px;
            overflow: scroll;
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-dark text-light">
        <div class="row">
            <div class="card bg-dark text-light w-100">
            <div class="card-header text-center text-uppercase">
                <?php foreach($actor as $key => $value): ?>
                    <?php if($key == 0):?>
                        <div class="text-uppercase text-center"><h1><?= $value['fullname'];?></h1></div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <div class="card-body">
                <div class="row">
                    
                        <div class="col-6">
                            <div class="col-12">
                                <div class="list-group-item bg-dark text-light border-secondary mt-1">
                                    <h2>Directed:</h2>
                                        <?php foreach($actorAll as $key => $value): ?>
                                            <?php if($value['imdb_position_id'] == 255): ?>
                                                <p><a href="movie.php?id=<?= $value['imdb_id']; ?>"><?= $value['name'];?></a></p>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                </div>
                                <div class="list-group-item bg-dark text-light border-secondary mt-1">
                                    <h2>Written:</h2>
                                        <?php foreach($actorAll as $key => $value): ?>
                                            <?php if($value['imdb_position_id'] == 256): ?>
                                                <p><a href="movie.php?id=<?= $value['imdb_id']; ?>"><?= $value['name'];?></a></p>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                </div>
                                <div class="list-group-item bg-dark text-light border-secondary mt-1">
                                    <h2>Produced:</h2>
                                        <?php foreach($actorAll as $key => $value): ?>
                                            <?php if($value['imdb_position_id'] == 257): ?>
                                                <p><a href="movie.php?id=<?= $value['imdb_id']; ?>"><?= $value['name'];?></a></p>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <div class="list-group-item bg-dark text-light border-secondary mt-1">
                                    <h2>Played in:</h2>
                                        <div class="scroll">
                                            <?php foreach($actorAll as $key => $value): ?>
                                                <?php if($value['imdb_position_id'] == 254): ?>
                                                    <p><a href="movie.php?id=<?= $value['imdb_id']; ?>"><?= $value['name'];?></a>  <small>(<?= $value['description'];?>)</small></p>
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

</script>
</body>
</html>