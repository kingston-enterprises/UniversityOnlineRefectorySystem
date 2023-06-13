<?php

namespace kingston\icarus\form;

$form = new Form();

?>
<title><?php echo $title ?></title>

<!-- Section: register -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5">

        <div class="card m-2" style="width: 80%">
            <div class="card-header">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <!-- registration form -->
                <?php $form = Form::begin('', 'post') ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Firstname</label>
                    <?php echo $form->field($model, 'firstname') ?>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Last Name</label>
                    <?php echo $form->field($model, 'lastname') ?>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Email</label>
                    <?php echo $form->field($model, 'email') ?>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Password</label>
                    <?php echo $form->field($model, 'password')->passwordField() ?>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">confirm Password</label>
                    <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
                </div>

                <button type="submit" class="btn btn-success">Register</button>

                <div class="text-sm-center">
                    <p class="m-4 text-sm" aria-label="">
                        Dont have an acount?
                        <a href="/auth/login" class="fs-6">
                            Login Here</a>.
                    </p>
                </div>

                <?php Form::end() ?>
            </div>
        </div>

    </div>
</section>