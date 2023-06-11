<?php

use kingston\icarus\Application;

use kingstonenterprises\app\models\User;

if (!Application::isGuest()) {
    $user = new User;
    $user = $user->findOne([
        'id' => Application::$app->session->get('user')
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <!-- bosststrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- popper js cdn -->
</head>

<body style="width: 100vw;height: 100vh;">
    <nav class="navbar navbar-expand-lg bg-warning-tertiary">
        <div class="container-fluid d-flex flex-row justify-content-between">
            <a class="nav-link active" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <?php if (Application::isGuest()) : ?>

                        <li class="nav-item">
                            <a class="nav-link active" href="/auth/login/">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/auth/register/">Register</a>
                        </li>
                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard">
                                <?php echo $user->getDisplayName() ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/auth/logout">
                                Logout
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
            <a class="nav-link active" href="/cart">cart</a>

        </div>
    </nav>

    <?php if (Application::$app->session->getFlash('success')) : ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php elseif (Application::$app->session->getFlash('warning')) : ?>
        <div class="alert alert-warning" role="alert">
            <p><?php echo Application::$app->session->getFlash('warning') ?></p>
        </div>
    <?php endif; ?>
    {{content}}
</body>

</html>