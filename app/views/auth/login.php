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

    </div>
</section>
