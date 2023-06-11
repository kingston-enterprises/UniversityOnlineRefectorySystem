<?php

namespace kingston\icarus\form;

$form = new Form();
?>

<title><?php echo $title ?></title>

<!-- Landing Area -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-between border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 50%">
            <div class="card-body">
                <!-- Login form -->
                <?php $form = Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>

                <button type="submit" class="btn btn-success">Login</button>

                <div class="text-sm-center">
                    <p class="m-4 text-sm" aria-label="">
                        Dont have an acount?
                        <a href="/auth/register" class="fs-6">
                            Register Here</a>.
                    </p>
                </div>

                <?php Form::end() ?>
            </div>
        </div>
        <div style="width: 50%">
            <img src="/img/refectory.jpg" class="img-fluid img-thumbnail">
        </div>

    </div>
</section>


<section class="p-10 container d-flex align-items-center justify-content-center" style="width: 100vw;">

    <div class="accordion" id="accordionExample" style="width: 80%;">
        <?php
        foreach ($catergories->getIterator() as $key => $catergory) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button d-flex flex-column alilg-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <p><?php echo $catergory->title; ?></p>
                        <p><?php echo $catergory->description; ?></p>
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
                                    <?php $form = Form::begin('/cart/insert/' . $item->id, 'post') ?>
                                    <input type='submit' class="btn btn-primary" vaue='Add To Cart'/>


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