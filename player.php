<?php
/** @var PDO $db */
require "settings/init.php";

$playerId = $_GET['playerId'];
$player = $db->sql("SELECT * FROM players WHERE playerId = :playerId", [":playerId" => $playerId]);
$player = $player[0];
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
            <div class="row justify-content-center bg-primary rounded-3">
                <div class="col-12">
                   <h2 class="text-secondary m-1"> <?php echo $player->playerName?> - <?php echo $player->playerClub?> </h2>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-8">
                    <h4>Alder: <?php echo $player->playerAge?> år</h4>
                    <h4>Højde: <?php echo $player->playerHeight?> cm</h4>
                    <h4>Position: <?php echo $player->playerPrefPosition?></h4>
                    <h4>Fod: <?php echo $player->playerPrefLeg?></h4>
                    <?php
                    $stats = $db->sql("SELECT * FROM stats 
                   INNER JOIN matches ON statMatchId = matchId 
                   WHERE statPlayerId = :playerId", [":playerId" => $playerId]);

                    $games = [];

                    foreach ($stats as $stat) {
                        $games[] = $stat->statGameCounter;
                    }

                    $totalGames = array_sum($games);

                    $goals = [];

                    foreach ($stats as $stat) {
                        $goals[] = $stat->statGoals;
                    }

                    $totalGoals = array_sum($goals);

                    $assists = [];

                    foreach ($stats as $stat) {
                        $assists[] = $stat->statAssists;
                    }

                    $totalAssists = array_sum($assists);

                    $yellows = [];

                    foreach ($stats as $stat) {
                        $yellows[] = $stat->statYellows;
                    }

                    $totalYellows = array_sum($yellows);

                    $reds = [];

                    foreach ($stats as $stat) {
                        $reds[] = $stat->statReds;
                    }

                    $totalReds = array_sum($reds);
                    ?>
                    <h4>Kampe: <?php echo $totalGames; ?></h4>
                    <h4>Mål: <?php echo $totalGoals; ?></h4>
                    <h4>Assists: <?php echo $totalAssists; ?></h4>
                    <h4>Gule Kort: <?php echo $totalYellows; ?></h4>
                    <h4>Røde Kort: <?php echo $totalReds; ?></h4>


                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <img class="img-fluid rounded-3 shadow" src="images/<?php echo $player->playerImg ?>" alt="<?php echo $player->playerName ?>">
                </div>
            </div>
        </div>
        <div class="col-11 mt-3">
            <div class="row rounded-3 border border-primary">
                <div class="col-12 bg-primary rounded-3">
                    <h2 class="text-secondary m-1">Statistikker</h2>
                </div>
                <div class="col-12">
                    <table class="table bg-secondary">
                        <thead>
                        <tr>
                            <th class="bg-secondary">Kamp</th>
                            <th class="bg-secondary">Position</th>
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
                               INNER JOIN matches ON statMatchId = matchId 
                               WHERE statPlayerId = :playerId", [":playerId" => $playerId]);
                        foreach ($stats as $stat) { ?>
                            <tr>
                                <td class="bg-secondary"><?php echo $stat->matchName ?></td>
                                <td class="bg-secondary"><?php echo $stat->statPosition ?></td>
                                <td class="bg-secondary"><?php echo $stat->statMinutes ?></td>
                                <td class="bg-secondary"><?php echo $stat->statGoals ?></td>
                                <td class="bg-secondary"><?php echo $stat->statAssists ?></td>
                                <td class="bg-secondary"><?php echo $stat->statYellows ?></td>
                                <td class="bg-secondary"><?php echo $stat->statReds ?></td>
                                <td class="bg-secondary"><?php echo $stat->statSubIn ?></td>
                                <td class="bg-secondary"><?php echo $stat->statSubOut ?></td>
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

