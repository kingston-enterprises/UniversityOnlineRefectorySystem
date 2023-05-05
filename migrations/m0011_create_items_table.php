<?php

class m0011_create_items_table
{
    public function up()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                available INT,
                price FLOAT,
                catergory_id INT,
                img_src VARCHAR(255),
                FOREIGN KEY (catergory_id) REFERENCES item_catergories (id)
               ) ENGINE=INNODB";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS items;";
        $db->pdo->exec($SQL);
    }
}
