<?php
/** @var PDO $db */
require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Football</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/b608edf7c6.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-secondary">
<?php
include("includes/nav.php"); // Inkluderer navigationsmenuen i toppen
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-11">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <a href="matches.php">
                        <div class="carousel-item active bg-black rounded-3">
                            <img src="images/matchesHero.png" class="d-block w-100 rounded-3 opacity-25"
                                 alt="...">
                            <div class="position-absolute top-50 start-50 translate-middle text-primary fs-1">KAMPE
                            </div>
                        </div>
                    </a>
                    <a href="statistics.php">
                        <div class="carousel-item bg-black rounded-3">
                            <img src="images/statisticsHero.png" class="d-block w-100 rounded-3 opacity-25"
                                 alt="...">
                            <div class="position-absolute top-50 start-50 translate-middle text-primary fs-1">
                                STATISTIKKER
                            </div>
                        </div>
                    </a>
                    <a href="profile.php">
                        <div class="carousel-item bg-black rounded-3">
                            <img src="images/profileHero.png" class="d-block w-100 rounded-3 opacity-25"
                                 alt="...">
                            <div class="position-absolute top-50 start-50 translate-middle text-primary fs-1">MIN
                                PROFIL
                            </div>
                        </div>
                    </a>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-around">
        <div class="col-11 col-md-5">
            <div class="card bg-primary">
                <div class="card-header">
                    <h3 class="text-secondary">Seneste kampe</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <?php $matches = $db->sql("SELECT * FROM matches");
                        foreach ($matches as $match) { ?>
                            <li class="text-secondary"><a class="text-secondary" href="match.php?matchId=<?php echo $match->matchId?>"><?php echo $match->matchHome?> VS <?php echo $match->matchAway?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-11 col-md-5">
            <div class="card bg-primary">
                <div class="card-header">
                    <h3 class="text-secondary">Nye profiler</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <?php $players = $db->sql("SELECT * FROM players");
                        foreach ($players as $player) { ?>
                            <li class="text-secondary"><a class="text-secondary" href="match.php?matchId=<?php echo $player->playerId?>"><?php echo $player->playerName?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <?php
    include("includes/footer.php"); // Inkluderer navigationsmenuen i bunden
    ?>
</footer>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
