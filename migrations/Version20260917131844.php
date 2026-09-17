<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260917131844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE flyway_schema_history');
        $this->addSql('ALTER TABLE observation ADD plante_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE observation ALTER serie_id SET NOT NULL');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0177B16E8 FOREIGN KEY (plante_id) REFERENCES taxref (cd_nom) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_C576DBE0177B16E8 ON observation (plante_id)');
        $this->addSql('ALTER TABLE taxref ADD CONSTRAINT FK_C086DF4B2B50F59F FOREIGN KEY (cd_ref) REFERENCES taxref (cd_nom) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_C086DF4B2B50F59F ON taxref (cd_ref)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flyway_schema_history (installed_rank INT NOT NULL, version VARCHAR(50) DEFAULT NULL, description VARCHAR(200) NOT NULL, type VARCHAR(20) NOT NULL, script VARCHAR(1000) NOT NULL, checksum INT DEFAULT NULL, installed_by VARCHAR(100) NOT NULL, installed_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL, execution_time INT NOT NULL, success BOOLEAN NOT NULL, PRIMARY KEY (installed_rank))');
        $this->addSql('CREATE INDEX flyway_schema_history_s_idx ON flyway_schema_history (success)');
        $this->addSql('ALTER TABLE observation DROP CONSTRAINT FK_C576DBE0177B16E8');
        $this->addSql('DROP INDEX IDX_C576DBE0177B16E8');
        $this->addSql('ALTER TABLE observation DROP plante_id');
        $this->addSql('ALTER TABLE observation ALTER serie_id DROP NOT NULL');
        $this->addSql('ALTER TABLE taxref DROP CONSTRAINT FK_C086DF4B2B50F59F');
        $this->addSql('DROP INDEX IDX_C086DF4B2B50F59F');
    }
}
