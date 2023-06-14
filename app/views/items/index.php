<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded m-5 p-5">

        <div class="card m-2" style="width: 80%">
            <div class="card-header">
                <a href='/items/new/' class="m-3">
                    <button class="btn btn-info">
                        <span class="fs-6">Add New Item</h3>
                    </button>
                </a>
            </div>

            <div class="card-body fs-6">
                <?php
                foreach ($items->getIterator() as $key => $item) { ?>
                    <div class="p-5 list-group d-flex flex-row">
                        <div>
                            <img src="./img/<?php echo $item->img_src ?>" class="" style="width:180px;height:180px;">
                        </div>
                        <div>
                            <div class="list-group-item d-flex flex-column">
                                <h4><?php echo $item->title; ?></h4>
                                <p><?php echo $item->description; ?></p>
                                <p>Available: <?php echo ($item->available == 1) ? "Yes" : "No"; ?></p>
                            </div>
                            <div class="list-group-item d-flex flex-row mb-3">
                                <a href='/items/update/<?php echo $item->id; ?>' class="mx-2">
                                    <button class="btn btn-warning">
                                        <span class="fs-6">Edit</span>
                                    </button>
                                </a>
                                <span class="mx-2">
                                    <?php $form = Form::begin('/items/delete/' . $item->id, 'post') ?>

                                    <button type='submit' class="btn btn-danger">
                                        <span class="fs-6">Delete</span>
                                    </button>
                                    <?php Form::end() ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</section>