<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260619103954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxref ADD CONSTRAINT FK_C086DF4B2B50F59F FOREIGN KEY (cd_ref) REFERENCES taxref (cd_nom) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_C086DF4B2B50F59F ON taxref (cd_ref)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxref DROP CONSTRAINT FK_C086DF4B2B50F59F');
        $this->addSql('DROP INDEX IDX_C086DF4B2B50F59F');
    }
}
