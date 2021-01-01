<?php

class m0002_add_password_column
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL AFTER `email`");
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}
