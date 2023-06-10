<?php

namespace kingston\icarus\form;

$form = new Form();
?>
<title><?php echo $title ?></title>
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 80%">
            <div class="card-body">
            <img class="card-img-top" style="max-height:300px;"
                             src="/img/<?php echo $item->img_src ?>" alt="">
                </div>
                <?php $form = Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'title', $item->title) ?>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="availability" class="custom-control-input">
                    <label class="custom-control-label" for="available">available</label>
                </div>
                <?php echo $form->field($model, 'price', $item->price)->numberField() ?>
                <?php echo $form->textArea($model, 'description', $item->description, 3) ?>
                <select class="form-control" name="catergory">
                    <?php foreach ($catergories->getIterator() as $key => $catergory) { ?>
                        <option class="form-control" value="<?php echo $catergory->title ?>"><?php echo $catergory->title ?></option>
                    <?php } ?>
                </select>
                <div class="form-group">
                    <label for="image source">Item Image</label>
                    <input type="file" name="img_src" accept="" />
                </div>

                <button type="submit" class="btn btn-success">Update Item</button>

                <?php Form::end() ?>
            </div>
        </div>

    </div>
</section>
