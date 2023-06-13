<?php

namespace kingston\icarus\form;

$form = new Form();

?>
<title><?php echo $title ?></title>

<!-- Section: Login -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5 m-5">

        <div class="card m-2" style="width: 50%">
            <div class="card-header">
                <h4>Add A new Catergory</h4>
            </div>
            <div class="card-body">
                <?php $form = Form::begin('', 'post') ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Catergory Title</label>
                    <div id="titleHelp" class="form-text">e.g breakfast foods</div>
                    <?php echo $form->field($model, 'title') ?>
                </div>

                <div class="mb-3">
                    <label for="Catergory" class="form-label">Catergory description</label>
                    <div id="catergoryHelp" class="form-text">e.g hot breakfast foods</div>
                    <?php echo $form->textArea($model, 'description', 'Catergory Description', 3) ?>
                </div>

                <button type="submit" class="btn btn-success">Create New Catergory</button>
                <?php Form::end() ?>
            </div>
        </div>

    </div>
</section>