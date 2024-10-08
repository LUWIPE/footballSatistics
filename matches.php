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
<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-11 rounded-3 border border-primary">
            <div class="row">
                <div class="bg-primary rounded-3">
                    <h1 class="text-secondary">Kampe</h1>
                </div>
                <div>
                    <table class="table bg-secondary">
                        <thead>
                        <tr>
                            <th class="bg-secondary">Kamp</th>
                            <th class="bg-secondary">Dato</th>
                            <th class="bg-secondary">Hjemme</th>
                            <th class="bg-secondary">Resultat</th>
                            <th class="bg-secondary">Ude</th>
                            <th class="bg-secondary"></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $matches = $db->sql("SELECT * FROM matches 
                               ORDER BY matchDate DESC");
                        foreach ($matches as $match) { ?>
                            <tr>
                                <td class="bg-secondary"><?php echo $match->matchName ?></td>
                                <td class="bg-secondary"><?php echo date('j-m-Y', strtotime ($match->matchDate))?></td>
                                <td class="bg-secondary"><?php echo $match->matchHome ?></td>
                                <td class="bg-secondary"><?php echo $match->matchHomeGoals ?> - <?php echo $match->matchAwayGoals ?></td>
                                <td class="bg-secondary"><?php echo $match->matchAway ?></td>
                                <td class="bg-secondary"><a class="text-primary text-end" href="match.php?matchId=<?php echo $match->matchId ?>">Se kamp</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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

