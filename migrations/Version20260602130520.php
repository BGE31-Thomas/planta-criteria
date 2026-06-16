<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260602130520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD observation_critere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCC2F91C6 FOREIGN KEY (observation_critere_id) REFERENCES observation_critere (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_C53D045FCC2F91C6 ON image (observation_critere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045FCC2F91C6');
        $this->addSql('DROP INDEX IDX_C53D045FCC2F91C6');
        $this->addSql('ALTER TABLE image DROP observation_critere_id');
    }
}
