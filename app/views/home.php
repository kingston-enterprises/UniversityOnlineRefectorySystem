<?php
namespace kingston\icarus\form;
$form = new Form();
?>

<title><?php echo $title ?></title>

<!-- Landing Area -->
<section id="landing-area" class="h-full p-10" aria-label="Landing Area">
  <div class=" rounded-lg shadow-lg p-6 bg-white md:px-12 text-gray-800 text-center lg:text-left" aria-label="Landing Area Main Section">

      <div class="h-full flex flex-row justify-around align-middle lg:mt-0">

        <div class="w-5/12 m-2 block rounded-lg shadow-lg py-10 md:py-12 px-4 md:px-6">
          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 mb-12">
          </div>
          <div class="max-w-lg mx-auto">
            <!-- Login form -->
            <?php $form = Form::begin('', 'post') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordField() ?>

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
            ease-in-out" aria-label="Contact Section Form Submit Button">Login</button>

            <div class="text-center">
              <p class="m-4 text-sm" aria-label="">
                Already have an acount?
                <a href="/auth/register" class="inline-block text-blue-500 font-medium text-xs leading-tight underline hover:text-blue-700">
                  Register Here</a>.
              </p>
            </div>

            <?php Form::end() ?>
          </div>
        </div>
        <div class="w-5/12 m-2 lg:mb-0">
          <img src="/img/refectory.jpg" class="w-full h-full rounded-lg shadow-lg" alt="image of a school cafeteria" aria-label="Landing Area Main Image">
        </div>
      </div>

  </div>
</section>