<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10 d-flex justify-content-center align-items-center" style="width: 100vw;">

    <div class="card m-2" style="width: 80%">
        <div class="card-header">
            <p>Your Orders</p>
        </div>

        <div class="accordion p-5 d-flex justify-content-center align-items-center" id="accordionExample">
            <?php
            if ($orders->count() == 0) { ?>
                <div class="p-5 w-12/12 flex flex-row flex-wrap items-center justify-between border-y lg:justify-start">
                    No Orders
                </div>

                <?php } else {
                foreach ($orders->getIterator() as $order) { ?>
                    <div class="accordion-item" style="width: 90%;">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button d-flex flex-column aling-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <p><?php echo $order->date_created; ?></p>
                                <p>Total Due: E<?php echo $order->total; ?></p>
                                <p>settled: <?php echo ($order->settled == 1) ? "Yes" : "No"; ?></p>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body d-flex flex-column">
                                <?php foreach ($orderItems->getIterator() as $orderItem) { ?>
                                    <div class="card m-1" style="width: 100%">
                                        <div class="card-header">
                                            <?php echo $orderItem->item->title; ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $orderItem->item->description; ?></h5>
                                            <p class="card-text">E <?php echo $orderItem->item->price; ?></p>
                                            <p>Available: <?php echo ($orderItem->item->available == 1) ? "Yes" : "No"; ?></p>
                                            <a href="/orders/delete/<?php echo $orderItem->item->id ?>" class="btn btn-warning">Remove</a>

                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                        </div>
                    </div>
            <?php
                }
            }

            ?>
        </div>
    </div>

</section>