<?php

namespace kingstonenterprises\app\models;

use kingston\icarus\DbModel;

class CartItem extends DbModel
{
    /** @var integer id */
    public int $id = 0;

    /** @var int user_id */
    public int $user_id = 0;

    /** @var int cart_id */
    public int $cart_id = 0;

    /** @var int item_id */
    public int $item_id = 0;

    /** @var string date_added */
    public string $date_added = '';


    public function __construct()
    {
        $this->setAttributes(
            ['user_id', 'cart_id', 'item_id', 'date_added']
        );
        // form submission rules
        $this->setRules(
            [
                'user_id' => [self::RULE_REQUIRED],
                'cart_id' => [self::RULE_REQUIRED],
                'item_id' => [self::RULE_REQUIRED],
                'date_added' => [self::RULE_REQUIRED]
            ]
        );
    }

    /**
     * return database table name
     *
     * @return string
     */
    public static function tableName(): string
    {
        return 'cart_items';
    }

    public function save(): bool
    {
        return parent::save();
    }


    public function getDisplayName(): string
    {
        return $this->item_id;
    }
}
