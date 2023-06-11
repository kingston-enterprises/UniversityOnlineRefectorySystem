<?php

namespace kingstonenterprises\app\models;

use kingston\icarus\DbModel;

class Cart extends DbModel
{
    /** @var integer id */
    public int $id = 0;

    /** @var string title */
    public string $user_id = '';

    /** @var int total */
    public int $total = 0;

    /** @var integer settled */
    public int $settled = 0;

    /** @var string date_created */
    public string $date_created = '';


    public function __construct()
    {
        $this->setAttributes(
            ['user_id', 'total', 'settled', 'date_created']
        );
        // form submission rules
        $this->setRules(
            [
                'user_id' => [self::RULE_REQUIRED],
                'total' => [self::RULE_REQUIRED],
                'settled' => [self::RULE_REQUIRED]
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
        return 'carts';
    }

    public function save(): bool
    {
        return parent::save();
    }


    public function getDisplayName(): string
    {
        return $this->date_created . ':' . ($this->settled == 1) ? "Yes" : "No";
    }
}
