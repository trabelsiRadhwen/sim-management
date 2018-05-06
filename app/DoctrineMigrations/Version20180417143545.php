<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417143545 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent_commercial CHANGE tel tel VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE sim CHANGE numero_serie numero_serie VARCHAR(10) NOT NULL, CHANGE numero_appel numero_appel VARCHAR(8) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent_commercial CHANGE tel tel VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sim CHANGE numero_serie numero_serie VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE numero_appel numero_appel VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
