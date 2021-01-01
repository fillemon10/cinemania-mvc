<?php

use app\core\Application;

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `role` enum('Admin','Author','Moderator','Member') NOT NULL DEFAULT 'Member',
                `status` tinyint NOT NULL,
                `created_at` timestamp NULL DEFAULT current_timestamp(),
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`)) ENGINE=InnoDB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE `users`";
        $db->pdo->exec($SQL);
    }
}
