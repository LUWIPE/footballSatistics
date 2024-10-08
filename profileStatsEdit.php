<?php
/** @var PDO $db */
require "settings/init.php";


if (!empty($_POST['data'])) {
    $data = $_POST['data'];
    $db->sql("INSERT INTO stats (statMatchId, statPlayerId, statMinutes, statSubIn, statSubOut, statGoals, statAssists, statYellows, statReds, statPosition)
                  VALUES (:statMatchId, :statPlayerId, :statMinutes, :statSubIn, :statSubOut, :statGoals, :statAssists, :statYellows, :statReds, :statPosition)",
        [":statMatchId" => $data["statMatchId"], ":statPlayerId" => $data["statPlayerId"], ":statMinutes" => $data["statMinutes"],
            ":statSubIn" => $data["statSubIn"], ":statSubOut" => $data["statSubOut"], ":statGoals" => $data["statGoals"], ":statAssists" => $data["statAssists"],
            ":statYellows" => $data["statYellows"], ":statReds" => $data["statReds"], ":statPosition" => $data["statPosition"]]);

    header("Location: profile.php?playerId=" . $data["statPlayerId"]);
    exit();
}

$playerId = $_GET['playerId'];

$stat = $db->sql("SELECT * FROM stats INNER JOIN players ON statPlayerId = playerId INNER JOIN matches ON statMatchId = matchId WHERE playerId = :playerId", [":playerId" => $playerId]);
$stat = $stat[0];
?>
<!DOCTYPE html>
<html lang="da" class="h-100">
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

<body>

<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="mb-3">
                <a href="javascript:history.back()"><i class="fa-solid fa-arrow-left fs-1 text-primary"></i></a>
            </div>
            <div class="row rounded-3 border border-primary mb-5 bg-secondary shadow-lg">
                <div class="rounded-3 bg-primary">
                    <h2 class="text-secondary m-1">Tilføj statistik</h2>
                </div>
                <div class=" mb-3">
                    <form action="profileStatsEdit.php" method="post">
                        <div class="row justify-content-between">
                            <div class="col-6 mt-2">
                                <label for="statMatchId" class="form-label">Kamp</label>
                                <select class="form-select border-primary" aria-label="statMatchId" id="statMatchId" name="data[statMatchId]">
                                    <?php
                                    $matches = $db->sql("SELECT * FROM matches");
                                    foreach ($matches as $match){?>
                                        <option value="<?php echo $match->matchId ?>"
                                            <?php if ($match->matchId == $stat->statMatchId) echo 'selected'; ?>>
                                            <?php echo $match->matchName ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statPlayerId" class="form-label">Spiller</label>
                                <select class="form-select border-primary" aria-label="statPlayerId" id="statPlayerId" name="data[statPlayerId]">
                                    <option value="<?php echo $stat->playerId ?>"
                                        <?php if ($stat->player == $stat->statPlayerId) echo 'selected'; ?>>
                                        <?php echo $stat->playerName ?></option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statPosition" class="form-label">Position</label>
                                <select class="form-select border-primary" aria-label="statPosition" id="statPosition" name="data[statPosition]">
                                    <?php
                                    $positions = $db->sql("SELECT * FROM positions");
                                    foreach ($positions as $position){?>
                                        <option value="<?php echo $position->positionName ?>"><?php echo $position->positionName ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statMinutes" class="form-label">Minutter</label>
                                <input type="number" class="form-control border-primary" id="statMinutes"
                                       name="data[statMinutes]" placeholder="Minutter"
                                       value="">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statSubIn" class="form-label">Indskiftet</label>
                                <select class="form-select border-primary" aria-label="statSubIn" id="statSubIn" name="data[statSubIn]">
                                    <option value="Nej">Nej</option>
                                    <option value="Ja">Ja</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statSubOut" class="form-label">Udskiftet</label>
                                <select class="form-select border-primary" aria-label="statSubOut" id="statSubOut" name="data[statSubOut]">
                                    <option value="Ja">Ja</option>
                                    <option value="Nej">Nej</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statGoals" class="form-label">Mål</label>
                                <input type="number" class="form-control border-primary" id="statGoals"
                                       name="data[statGoals]" placeholder="Mål"
                                       value="">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statAssists" class="form-label">Assists</label>
                                <input type="number" class="form-control border-primary" id="statAssists"
                                       name="data[statAssists]" placeholder="Assists"
                                       value="">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statYellows" class="form-label">Gule kort</label>
                                <input type="number" class="form-control border-primary" id="statYellows"
                                       name="data[statYellows]" placeholder="Gule kort"
                                       value="">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="statReds" class="form-label">Røde kort</label>
                                <input type="number" class="form-control border-primary" id="statReds"
                                       name="data[statReds]" placeholder="Røde kort"
                                       value="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end updateLink mt-2">
                            <button type="submit" class="btn btn-primary text-secondary">Tilføj statistik</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

