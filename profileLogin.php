<?php
/** @var PDO $db */
require "settings/init.php";
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
        <div class="col-8 rounded-3 border border-primary bg-secondary shadow-lg">
            <div class="row justify-content-center rounded-3 border border-primary">
                <div class="row rounded-3 bg-primary">
                    <div class="col-10">
                        <p class="fs-2 m-1 text-secondary">Log In</p>
                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-center">
                        <a href="javascript:history.back()" class="m-1"><i class="fa-solid fa-xmark text-secondary fs-2 text-end"></i></a>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-10 mt-5 mb-5">
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">E-mail</label>
                                <input type="email" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control border-primary" id="exampleInputPassword1">
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="profile.php?playerId=1" class="btn btn-primary">Log In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
