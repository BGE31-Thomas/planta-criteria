<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260401080315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, organe VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, plante_id BIGINT DEFAULT NULL, source_id INT DEFAULT NULL, INDEX IDX_7F6A8053177B16E8 (plante_id), UNIQUE INDEX UNIQ_7F6A8053953C1C61 (source_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, chemin VARCHAR(255) NOT NULL, auteur VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, critere_id INT DEFAULT NULL, INDEX IDX_C53D045F9E5F45AB (critere_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) DEFAULT NULL, annee INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053177B16E8 FOREIGN KEY (plante_id) REFERENCES taxref (cd_nom)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A8053953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053177B16E8');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A8053953C1C61');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F9E5F45AB');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE source');
    }
}
