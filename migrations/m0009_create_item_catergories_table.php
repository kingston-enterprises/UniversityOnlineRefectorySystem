<?php

class m0009_create_item_catergories_table
{
    public function up()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS item_catergories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL
               ) ENGINE=INNODB";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS item_catergories;";
        $db->pdo->exec($SQL);
    }
}
