<?php

namespace kingston\icarus\form;

$form = new Form();

?>
<title><?php echo $title ?></title>

<!-- Section: register -->
<section id="register" class="container my-24 px-6" aria-label="Register Section">
  <div class="container w-full flex justify-center  text-gray-800 px-4 md:px-12">
    <div class="w-8/12 block rounded-lg bg-white shadow-lg py-10 md:py-12 px-4 md:px-6">
      <div class="max-w-lg mx-auto">
        <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'firstname') ?>
        <?php echo $form->field($model, 'lastname') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordField() ?>
        <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>

        <button type="submit" class="block w-full p-3 font-bold bg-blue-600 text-white
            text-xs
            leading-tight
            uppercase
            rounded
            shadow-md
            hover:bg-blue-700 hover:shadow-lg
            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
            active:bg-blue-800 active:shadow-lg
            transition
            duration-150
            ease-in-out" aria-label="Contact Section Form Submit Button">Register</button>

        <div class="text-center">
          <p class="m-4 text-sm" aria-label="">
            Already have an acount?
            <a href="/auth/login" class="inline-block text-blue-500 font-medium text-xs leading-tight underline hover:text-blue-700">
              Login Here</a>.
          </p>
        </div>

        <?php Form::end() ?>
      </div>
    </div>
  </div>
</section>