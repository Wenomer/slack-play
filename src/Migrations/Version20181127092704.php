<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20181127092704 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
             CREATE TABLE `game` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->addSql('
             CREATE TABLE `game_player` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `game_id` int(10) unsigned NOT NULL,
              `name` varchar(255) NOT NULL
              PRIMARY KEY (`id`),
              UNIQUE KEY `game_player_name` (`game_id`,`name`) USING BTREE,
              CONSTRAINT `game_player` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_player');
    }
}
