<?php

namespace kingston\icarus\form;

$form = new Form();
?>

<title><?php echo $title ?></title>

<!-- Landing Area -->
<section class="p-10 container d-flex align-items-center justify-content-center" style="width: 100vw;">

    <div class="accordion m-5" id="accordionExample" style="width: 80%;">
        <?php
        foreach ($catergories->getIterator() as $key => $catergory) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <div>
                        <p><?php echo $catergory->title; ?></p>
                    </div>

                    <button class="accordion-button d-flex flex-column alilg-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex flex-row">
                        <?php foreach ($catergory->items->getIterator() as $key => $item) { ?>

                            <div class="card m-2" style="width: 14rem;">
                                <img class="card-img-top" style="height: 10rem;" src="./img/<?php echo $item->img_src ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item->title; ?></h5>
                                    <p class="card-text"><?php echo $item->description; ?></p>
                                    <p>Available: <?php echo ($item->available == 1) ? "Yes" : "No"; ?></p>
                                    <?php $form = Form::begin('/orders/insert/' . $item->id, 'post') ?>
                                    <button type="submit" class="btn btn-primary">Order</button>

                                    <?php Form::end() ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>


</section>