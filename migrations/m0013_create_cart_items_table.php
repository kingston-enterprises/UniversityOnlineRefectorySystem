
<?php

class m0013_create_cart_items_table
{
    public function up()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS cart_items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                cart_id INT,
                user_id INT,
                item_id INT,
                date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
               ) ENGINE=INNODB";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = kingston\icarus\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS cart_items;";
        $db->pdo->exec($SQL);
    }
}
