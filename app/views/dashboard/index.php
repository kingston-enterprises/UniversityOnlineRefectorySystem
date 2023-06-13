<?php

use kingston\icarus\Application;
?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 80%">
            <div class="card-header">
                Dashboard
            </div>

            <div class="card-body fs-6">
                <h4>Name: <?php echo $user->getDisplayName(); ?> </h4>
                <h4>Email: <?php echo $user->email; ?></h4>
                <h4>since: <?php echo $user->joined; ?></h4>
                <h4>role: <?php echo $user->role->getDisplayName(); ?></h4>
            </div>
            <div class="card-footer d-flex flex-wrap">

                <?php
                var_dump(Application::$app->session->get('role'));
                if (Application::$app->session->get('role') == 1) { // admin actions
                ?>
<a href='/catergories' class="m-3">
                    <button class="btn btn-info">
                        <span class="fs-6"><?php echo $catergories; ?> Catergories</span>
                    </button>
                </a>
                <a href='/items' class="m-3">
                    <button class="btn btn-info">
                        <span class="fs-6"><?php echo $items; ?>Items</h3>
                    </button>
                </a><a href='/orders/view' class="m-3">
                    <button class="btn btn-info">
                        <span class="fs-6"><?php echo $orders; ?> orders</span>
                    </button>
                </a>

                <?php
                } 
                ?>
                
            </div>
        </div>
    </div>

</section>