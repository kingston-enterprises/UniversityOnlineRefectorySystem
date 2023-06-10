<?php

namespace kingston\icarus\form;

$form = new Form();

?>
<title><?php echo $title ?></title>

<!-- Section: Login -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 80%">
            <div class="card-body">
                <?php $form = Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'title') ?>
                <?php echo $form->textArea($model, 'description', 'Catergory Description', 3) ?>

                <button type="submit" class="btn btn-success">Create New Catergory</button>

                <?php Form::end() ?>
            </div>
        </div>

    </div>
</section>
