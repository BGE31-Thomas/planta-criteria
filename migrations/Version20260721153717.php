<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260721153717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE observation ADD serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE observation DROP date_heure');
        $this->addSql('ALTER TABLE observation DROP lieu');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_C576DBE0D94388BD ON observation (serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE observation DROP CONSTRAINT FK_C576DBE0D94388BD');
        $this->addSql('DROP INDEX IDX_C576DBE0D94388BD');
        $this->addSql('ALTER TABLE observation ADD date_heure TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE observation ADD lieu VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE observation DROP serie_id');
    }
}
