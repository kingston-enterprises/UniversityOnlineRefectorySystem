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
 * ItemCatergory class used to represent item catergories in the system
 * 
 * @extends \kingston\icarus\DbModel
 */
class ItemCatergory extends DbModel
{
    /** @var integer id */
    public int $id = 0;

    /** @var string title */
    public string $title = '';

    /** @var string description */
    public string $description = '';


    public function __construct()
    {
        $this->setAttributes(
            ['title', 'description']
        );
        // form submission rules
        $this->setRules(
            [
                'title' => [self::RULE_REQUIRED],
                'description' => [self::RULE_REQUIRED]
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
        return 'item_catergories';
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
