<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261015122411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD COLUMN informations CLOB NOT NULL');
        $this->addSql('ALTER TABLE event ADD COLUMN category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD COLUMN nb_places INTEGER NOT NULL');
        $this->addSql('ALTER TABLE event ADD COLUMN image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, titre, date, status FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO event (id, titre, date, status) SELECT id, titre, date, status FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
    }
}
