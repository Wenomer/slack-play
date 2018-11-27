<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20181127092704 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
             CREATE TABLE `match` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->addSql('
             CREATE TABLE `match_player` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `match_id` int(10) unsigned NOT NULL,
              `player` varchar(255) NOT NULL,
              `position` smallint(1) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `match_player_position` (`match_id`,`position`) USING BTREE,
              CONSTRAINT `match_player` FOREIGN KEY (`match_id`) REFERENCES `match` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE ');
        $this->addSql('ALTER TABLE match_player CHANGE match_id match_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE match_player ADD CONSTRAINT match_player FOREIGN KEY (match_id) REFERENCES `match` (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
