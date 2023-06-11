<?php

namespace kingston\icarus\form;

$form = new Form();
?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 80%">
            <div class="card-body">
                <!-- registration form -->
                <?php $form = Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'firstname') ?>
                <?php echo $form->field($model, 'lastname') ?>
                <?php echo $form->field($model, 'email') ?>

                <button type="submit" class="btn btn-success">update</button>

                <?php Form::end() ?>
            </div>
        </div>

    </div>
</section>