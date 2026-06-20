<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260619144047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxref DROP CONSTRAINT fk_c086df4b2b50f59f');
        $this->addSql('DROP INDEX idx_c086df4b2b50f59f');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxref ADD CONSTRAINT fk_c086df4b2b50f59f FOREIGN KEY (cd_ref) REFERENCES taxref (cd_nom) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c086df4b2b50f59f ON taxref (cd_ref)');
    }
}
