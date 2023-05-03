<?php

namespace kingston\icarus\form;

$form = new Form();



?>
<title><?php echo $title ?></title>

<!-- Main section -->
<section id="dashboard" class="h-screen p-10" aria-label="Dashboard Section">
    <div class="container w-full flex justify-center text-gray-800 px-4 md:px-12">

        <div class="w-10/12 rounded-lg shadow-lg py-10 md:py-8 bg-white px-4 md:px-6">
            <div class="p-5 flex flex-row flex-wrap items-center justify-center lg:justify-start">
                <div class="m-3 bg-white shadow border rounded-lg p-4" aria-label="total visitors stats">
                    <a href='/catergories/new/' class="flex items-center cursor-pointer " aria-label="total visitors">
                        <h3 class="text-base font-normal text-gray-500">Add New Catergory</h3>
                    </a>
                </div>

            </div>
            <div class="flex flex-col">
                <?php
                foreach ($catergories->getIterator() as $key => $catergory) { ?>
                    <div class="p-5 w-12/12 flex flex-row flex-wrap items-center justify-between border-y lg:justify-start">
                        <div class="w-5/12 flex flex-col">
                            <h4><?php echo $catergory->title; ?></h4>
                            <p><?php echo $catergory->description; ?></p>
                        </div>
                        <div class=" w-5/12 flex flex-row justify-center">
                            <div class="m-3 bg-white shadow border rounded-lg p-4" aria-label="total visitors stats">
                                <a href='/catergories/update/<?php echo $catergory->id; ?>' class="flex items-center cursor-pointer " aria-label="total visitors">
                                    <h3 class="text-base font-normal text-gray-500">Edit</h3>
                                </a>
                            </div>
                            <div class="m-3 bg-white shadow border rounded-lg p-4" aria-label="total visitors stats">
                                <?php $form = Form::begin('/catergories/delete/' . $catergory->id, 'post') ?>
                                <button type="submit" class="flex items-center cursor-pointer " aria-label="total visitors">
                                    <h3 class="text-base font-normal text-gray-500">Delete</h3>
                                </button>

                                <?php Form::end() ?>


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