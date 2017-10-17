<?php
require 'db.php';

$query = 'SELECT * FROM `imdb_movie` 
LEFT JOIN `imdb_movie_type`
ON `imdb_movie`.`imdb_movie_type_id` = `imdb_movie_type`.`id`
WHERE `imdb_movie`.`imdb_id` = ?';
$id = $_GET['id'];
$stmt = db::query($query, [$id]);
$data = $stmt->fetchAll();

$query2 = 'SELECT * FROM `imdb_movie_has_genre`
LEFT JOIN `imdb_genre`
ON `imdb_movie_has_genre`.`imdb_genre_id` = `imdb_genre`.`id`
WHERE `imdb_movie_id` = ?';
$stmt = db::query($query2, [$id]);
$genre = $stmt->fetchAll();

$query3 = 'SELECT * FROM `imdb_movie_has_origin_country`
LEFT JOIN `imdb_movie_origin_country`
ON `imdb_movie_has_origin_country`.`imdb_movie_origin_country_id` = `imdb_movie_origin_country`.`id`
WHERE `imdb_movie_id` = ?';
$stmt = db::query($query3, [$id]);
$country = $stmt->fetchAll();

$query4 = 'SELECT * FROM `imdb_movie_has_language`
LEFT JOIN `imdb_language`
ON `imdb_movie_has_language`.`imdb_language_id` = `imdb_language`.`id`
WHERE `imdb_movie_id` = ?';
$stmt = db::query($query4, [$id]);
$language = $stmt->fetchAll();

$query4 = 'SELECT * FROM `imdb_movie_has_person`
LEFT JOIN `imdb_person`
ON `imdb_movie_has_person`.`imdb_person_id` = `imdb_person`.`imdb_id`
LEFT JOIN `imdb_position`
ON `imdb_movie_has_person`.`imdb_position_id` = `imdb_position`.`id`
WHERE `imdb_movie_id` = ?';
$stmt = db::query($query4, [$id]);
$actors = $stmt->fetchAll();
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
        height: 450px;
        overflow: scroll;
    }
    </style>
</head>
<body class="bg-dark">
<div class="container-fluid bg-dark text-light">
    <div class="row">

        <!-- MOBILE ABOUT -->
        <div class="card bg-dark text-light w-100">
            <div class="card-header text-center text-uppercase d-flex justify-content-around">
                <span><h1><?php foreach($data as $movie) {echo $movie['name'];}?></h1><small>(<?php foreach($data as $movie) {echo $movie['label'];}?>)</small></span>
                <div class="row justify-content-between">
                    <div class="col-5">
                        <div class="logo">
                            <a href="http://www.imdb.com/title/tt2707408/" target="_blank"><img src="img/imdb-logo.png" alt="IMDB logo"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="progress_bar mt-3">
                            <div class="progress">
                                <div class="progress-bar bg-progress" role="progressbar" style="width: <?php foreach ($data as $movie) {$rating = $movie['rating'] * 10; echo $rating;}?>%" aria-valuenow="<?php foreach ($data as $movie) {$rating = $movie['rating'] * 10; echo $rating;}?>" aria-valuemin="0" aria-valuemax="100"><?php foreach ($data as $movie) {$rating = $movie['rating'] * 10; echo $rating;}?>%
                                <small>(<?php foreach($data as $movie) {echo $movie['votes_nr'];}?> votes)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <li class="list-group-item bg-dark text-light border-secondary">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title text-uppercase">Genres:</h4>
                        <p class="card-text"><?php foreach($genre as $array):?><?= $array["name"].' ';?><?php endforeach;?></p>
                        
                        <h4 class="card-title text-uppercase">Directed by:</h4>
                            <?php foreach($actors as $values): ?>
                                <?php if($values['imdb_position_id'] == 255): ?>
                                    <a href="actor.php?id=<?=$values['imdb_id'];?>"><p class="card-text"><?= $values['fullname'];?></p></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <h4 class="card-title text-uppercase mt-2">Written by:</h4>
                            <?php foreach($actors as $values): ?>
                                <?php if($values['imdb_position_id'] == 256): ?>
                                    <a href="actor.php?id=<?=$values['imdb_id'];?>"><p class="card-text"><?= $values['fullname'];?></p></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <h4 class="card-title text-uppercase mt-2">Produced by:</h4>
                            <?php foreach($actors as $values): ?>
                                <?php if($values['imdb_position_id'] == 257): ?>
                                    <a href="actor.php?id=<?=$values['imdb_id'];?>"><p class="card-text"><?= $values['fullname'];?></p></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <h4 class="card-title text-uppercase mt-2">Origin country and language:</h4>
                        <p class="card-text"><?php foreach($country as $array):?><?= $array["name"].' ';?><?php endforeach;?> - <?php foreach($language as $array):?><?= $array["name"].' ';?><?php endforeach;?></p>
                        <p class="card-text"></p>
                    </div>
                    <div class="col-6">
                        <div class="card bg-dark text-light">
                            <h4 class="card-title text-uppercase">cast:</h4>
                            <div class="scroll">
                                <?php foreach($actors as $values): ?>
                                    <?php if($values['imdb_position_id'] == 254): ?>
                                        <span class="d-flex"><a href="actor.php?id=<?=$values['imdb_id'];?>"><p class="card-text"><?= $values['fullname'];?></p></a>  <small class="ml-2">(<?= $values['description'];?>)</small></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>