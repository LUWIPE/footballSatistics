<?php
/** @var PDO $db */
require "settings/init.php";

if (!empty($_POST['playerId']) && !empty($_POST['data'])) {
    $data = $_POST['data'];
    $db->sql("UPDATE players SET playerName = :playerName, playerAge = :playerAge, playerHeight = :playerHeight, 
                  playerPrefPosition = :playerPrefPosition, playerPrefLeg = :playerPrefLeg WHERE playerId = :playerId",
        [":playerName" => $data["playerName"], ":playerAge" => $data["playerAge"], ":playerHeight" => $data["playerHeight"],
            ":playerPrefPosition" => $data["playerPrefPosition"], ":playerPrefLeg" => $data["playerPrefLeg"], ":playerId" => $_POST["playerId"]]);


    header("Location: profile.php?playerId=" . $_POST["playerId"]);
    exit();
}

$playerId = $_GET['playerId'];
$player = $db->sql("SELECT * FROM players WHERE playerId = :playerId", [":playerId" => $playerId]);
$player = $player[0];
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
                    <h2 class="text-secondary m-1">Rediger din profil</h2>
                </div>
                <div class="mb-3">
                    <form action="profileEdit.php" method="post">
                        <div class="col-12 mt-2">
                            <label for="playerName" class="form-label">Navn</label>
                            <input type="text" class="form-control border-primary" id="playerName"
                                   name="data[playerName]" placeholder="Navn"
                                   value="<?php echo $player->playerName ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="playerClub" class="form-label">Klub</label>
                            <input type="text" class="form-control border-primary" id="playerClub"
                                   name="data[playerClub]" placeholder="Klub"
                                   value="<?php echo $player->playerClub ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="playerAge" class="form-label">Alder</label>
                            <input type="text" class="form-control border-primary" id="playerAge" name="data[playerAge]"
                                   placeholder="Alder"
                                   value="<?php echo $player->playerAge ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="playerHeight" class="form-label">Højde</label>
                            <input type="text" class="form-control border-primary" id="playerHeight"
                                   name="data[playerHeight]" placeholder="Højde"
                                   value="<?php echo $player->playerHeight ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="playerPrefPosition" class="form-label">Position</label>
                            <input type="text" class="form-control border-primary" id="playerPrefPosition"
                                   name="data[playerPrefPosition]" placeholder="Position"
                                   value="<?php echo $player->playerPrefPosition ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="playerPrefLeg" class="form-label">Fod</label>
                            <input type="text" class="form-control border-primary" id="playerPrefLeg"
                                   name="data[playerPrefLeg]" placeholder="Fod"
                                   value="<?php echo $player->playerPrefLeg ?>">
                        </div>
                        <div class="d-flex justify-content-end updateLink mt-2">
                            <button type="submit" class="btn btn-primary text-secondary">Bekræft ændringer</button>
                        </div>
                        <input type="hidden" name="playerId" value="<?php echo $playerId ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

