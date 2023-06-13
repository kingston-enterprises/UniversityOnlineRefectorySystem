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
            <p>All Orders</p>
        </div>

        <div class="accordion p-5 d-flex justify-content-center align-items-center" id="accordionExample">
            <?php
            if ($orders->count() == 0) { ?>
                <div class="p-5 w-12/12 flex flex-row flex-wrap items-center justify-between border-y lg:justify-start">
                    No Orders
                </div>

                <?php } else {
                foreach ($orders->getIterator() as $order) { ?>
                    <ul class="list-group">
                        <li class="list-group-item active d-flex flex-column" aria-current="true">
                            <p><?php echo $order->user->getDisplayName() ?></p>
                            <p><?php echo date_format(date_create($order->date_created), 'l jS \of F Y h:i A') ?></p>
                            <p><?php echo " Total Due: E " . $order->total; ?></p>
                            <p><?php if ($order->settled == 1) { ?>
                                    <button class="btn btn-info">
                                        <span class="fs-6">Paid</span>
                                    </button>
                                <?php } else { ?>
                                    </a><a href='/orders/pay/<?php echo $order->id?>' class="m-3">
                                        <button class="btn btn-info">
                                            <span class="fs-6">Pay</span>
                                        </button>
                                    </a>
                                <?php } ?>
                            </p>
                        </li>
                        <?php foreach ($orderItems->getIterator() as $orderItem) {
                    if ($order->id == $orderItem->order_id) {
                        ?>

                            <li class="list-group-item"><?php echo $orderItem->item->title; ?>E <?php echo $orderItem->item->price; ?>
                            </li>
                        <?php } }?>

                    </ul>
            <?php
                }
            }

            ?>


        </div>
    </div>

</section>