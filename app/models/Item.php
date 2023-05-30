<?php

/**
 * @category models
 * @author kingston-5 <qhawe@kingston-enterprises.net>
 * @license For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace kingstonenterprises\app\models;

use kingston\icarus\DbModel;

/**
 * Items class used to represent items in the system
 * 
 * @extends \kingston\icarus\DbModel
 */
class Item extends DbModel
{
    /** @var integer id */
    public int $id = 0;

    /** @var string title */
    public string $title = '';

    /** @var string description */
    public string $description = '';

    /** @var integer available */
    public int $available = 0;

    /** @var float id */
    public float $price = 0;

    /** @var integer catergory_id */
    public int $catergory_id = 0;

    /** @var string img_src */
    public string $img_src = '';


    public function __construct()
    {
        $this->setAttributes(
            ['title', 'description', 'price', 'available', 'catergory_id', 'img_src']
        );
        // form submission rules
        $this->setRules(
            [
                'title' => [self::RULE_REQUIRED, [
                    self::RULE_UNIQUE, 'class' => self::class
                ]],
                'description' => [self::RULE_REQUIRED],
                'price' => [self::RULE_REQUIRED],
                'catergory_id' => [self::RULE_REQUIRED],
                'img_src' => [self::RULE_REQUIRED]
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
        return 'items';
    }


    /**
     * save record to database
     * we need to hash the user password 
     * before we save the record to the database
     *
     * @return boolean
     */
    public function save(): bool
    {
        return parent::save();
    }

    // methods to get attributes    
    /** 
     * return record Id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * return user display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->title . ':' . $this->description;
    }
}
