<?php

namespace kingston\icarus\form;

$form = new Form();
?>
<title><?php echo $title ?></title>

<!-- Section: Login -->
<section id="login" class="container p-6 mx-auto" aria-label="Login Section">
    <div class="mb-32 text-gray-800">
        <div class="container w-full flex justify-center text-gray-800 px-4 md:px-12">
            <div class="w-8/12 block rounded-lg shadow-lg py-10 md:py-12 px-4 md:px-6">
                <div class="flex justify-center align-middle pb-5">
                <img style="max-height:300px;"
                             src="/img/<?php echo $item->img_src ?>" alt="">
                </div>
                <div class="max-w-lg mx-auto">
                   
                    <?php $form = Form::begin('', 'post') ?>
                    <?php echo $form->field($model, 'title', $item->title) ?>
                    <div class="w-full flex flex-row align-middle justify-center">
                        <p>Available</p>
                    <?php echo $form->field($model, 'available', $item->available)->checkBoxField() ?>

                    </div>
                    <?php echo $form->field($model, 'price', $item->price)->numberField() ?>
                    <?php echo $form->textArea($model, 'description', $item->description, 3) ?>
                    <?php echo $form->dataList($model, 'catergory', $catergories->getProp('title')) ?>
                    <?php echo $form->FilePicker($model, 'img_src', 'image/*') ?>
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
            ease-in-out" aria-label="Contact Section Form Submit Button">Edit Item</button>

                    <?php Form::end() ?>
                </div>
            </div>
        </div>
</section>