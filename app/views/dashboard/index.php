<?php

use kingston\icarus\Application;
?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10" style="width: 100vw;">
    <div class="m-5 container d-flex align-items-center justify-content-center border rounded p-5">

        <div class="card m-2" style="width: 80%">
            <div class="card-header">
               <h4> Dashboard</h4>
            </div>

            <div class="card-body fs-6">
                <p>Name: <?php echo $user->getDisplayName(); ?> </p>
                <p>Email: <?php echo $user->email; ?></p>
                <p>joined: <?php echo $user->joined; ?></p>
                <p>status: <?php echo $user->role->title; ?></p>
            </div>
            <div class="card-footer d-flex flex-wrap">

                <?php
                if (Application::$app->session->get('role') == 1) { // admin actions
                ?>
                
                    <a href='/catergories' class="m-3">
                        <button class="btn btn-warning">
                            <span class="fs-6"><?php echo $catergories; ?> Catergories</span>
                        </button>
                    </a>
                    <a href='/items' class="m-3">
                        <button class="btn btn-warning">
                            <span class="fs-6"><?php echo $items; ?>Items</h3>
                        </button>
                    </a><a href='/orders/view' class="m-3">
                        <button class="btn btn-warning">
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