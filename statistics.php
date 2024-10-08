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
                    <h1 class="text-secondary">Statistikker</h1>
                </div>
                <div>
                    <table class="table bg-secondary">
                        <thead>
                        <tr>
                            <th class="bg-secondary">Navn</th>
                            <th class="bg-secondary">Klub</th>
                            <th class="bg-secondary">Kamp</th>
                            <th class="bg-secondary">Dato</th>
                            <th class="bg-secondary">Minutter</th>
                            <th class="bg-secondary">Mål</th>
                            <th class="bg-secondary">Assists</th>
                            <th class="bg-secondary">Gule Kort</th>
                            <th class="bg-secondary">Røde kort</th>
                            <th class="bg-secondary">Indskiftet</th>
                            <th class="bg-secondary">Udskiftet</th>
                            <th class="bg-secondary"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stats = $db->sql("SELECT * FROM stats 
                               INNER JOIN players ON statPlayerId = playerId
                               INNER JOIN matches ON statMatchId = matchId
                               ORDER BY matchDate DESC");
                        foreach ($stats as $stat) { ?>
                            <tr>
                                <td class="bg-secondary"><?php echo $stat->playerName ?></td>
                                <td class="bg-secondary"><?php echo $stat->playerClub ?></td>
                                <td class="bg-secondary"><?php echo $stat->matchName ?></td>
                                <td class="bg-secondary"><?php echo date('j-m-Y', strtotime ($stat->matchDate))?></td>
                                <td class="bg-secondary"><?php echo $stat->statMinutes ?></td>
                                <td class="bg-secondary"><?php echo $stat->statGoals ?></td>
                                <td class="bg-secondary"><?php echo $stat->statAssists ?></td>
                                <td class="bg-secondary"><?php echo $stat->statYellows ?></td>
                                <td class="bg-secondary"><?php echo $stat->statReds ?></td>
                                <td class="bg-secondary"><?php echo $stat->statSubIn ?></td>
                                <td class="bg-secondary"><?php echo $stat->statSubOut ?></td>
                                <td class="bg-secondary"><a class="text-primary text-end" href="player.php?playerId=<?php echo $stat->playerId ?>">Se spiller</a></td>
                                <td class="bg-secondary"><a class="text-primary text-end" href="match.php?matchId=<?php echo $stat->matchId ?>">Se kamp</a></td>
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

