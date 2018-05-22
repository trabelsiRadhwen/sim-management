<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180517223041 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE marque ADD offre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CE4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_5A6F91CE4CC8505A ON marque (offre_id)');
        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC2104CC8505A');
        $this->addSql('DROP INDEX IDX_2ECAC2104CC8505A ON sim');
        $this->addSql('ALTER TABLE sim DROP offre_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CE4CC8505A');
        $this->addSql('DROP INDEX IDX_5A6F91CE4CC8505A ON marque');
        $this->addSql('ALTER TABLE marque DROP offre_id');
        $this->addSql('ALTER TABLE sim ADD offre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC2104CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_2ECAC2104CC8505A ON sim (offre_id)');
    }
}
