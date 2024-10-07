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

<?php $matches = $db->sql("SELECT * FROM matches");
foreach ($matches

         as $match) { ?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <a href="match.php?matchId=<?php echo $match->matchId ?>"><div class="row justify-content-around bg-primary rounded-3">
                <div class="col-12 border-bottom">
                    <h3 class="text-secondary m-1"><?php echo $match->matchDate ?></h3>
                </div>
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <h1 class="text-secondary"><?php echo $match->matchHome ?></h1>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center border-end border-start">
                    <h1 class="text-secondary"><?php echo $match->matchHomeGoals ?>
                        - <?php echo $match->matchAwayGoals ?></h1>
                </div>
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <h1 class="text-center text-secondary"><?php echo $match->matchAway ?></h1>
                </div>
            </div></a>
        </div>
    </div>
<?php } ?>
<footer>
    <?php
    include("includes/footer.php"); // Inkluderer navigationsmenuen i bunden
    ?>
</footer>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

