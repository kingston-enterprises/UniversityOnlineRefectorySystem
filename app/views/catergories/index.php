<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section class="p-10" style="width: 100vw;">
    <div class="container d-flex align-items-center justify-content-center border rounded p-5" style="width: 80%;">

        <div class="card m-2" style="width: 80%">
            <div class="card-header">
                <a href='/catergories/new/' class="m-3">
                    <button class="btn btn-info">
                        <span class="fs-6">Add New Catergory</h3>
                    </button>
                </a>
            </div>

            <div class="card-body fs-6">
                <?php
                foreach ($catergories->getIterator() as $key => $catergory) { ?>
                    <div class="p-5 list-group">
                        <div class="list-group-item d-flex flex-column">
                            <h4><?php echo $catergory->title; ?></h4>
                            <p><?php echo $catergory->description; ?></p>
                        </div>
                        <div class="list-group-item d-flex flex-row mb-3">
                            <a href='/catergories/update/<?php echo $catergory->id; ?>' class="mx-2">
                                <button class="btn btn-info">
                                    <span class="fs-6">Edit</span>
                                </button>
                            </a>
                            <span class="mx-2">
                                <?php $form = Form::begin('/catergories/delete/' . $catergory->id, 'post') ?>

                                <button type='submit' class="btn btn-info">
                                    <span class="fs-6">Delete</span>
                                </button>
                                <?php Form::end() ?>
                            </span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</section>