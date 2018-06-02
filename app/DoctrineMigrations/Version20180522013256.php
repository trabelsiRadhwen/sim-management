<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180522013256 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE numero_appel (id INT AUTO_INCREMENT NOT NULL, id_marque INT DEFAULT NULL, numero_appel INT NOT NULL, INDEX IDX_AE6FF8807C582423 (id_marque), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE numero_appel ADD CONSTRAINT FK_AE6FF8807C582423 FOREIGN KEY (id_marque) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CE4CC8505A');
        $this->addSql('DROP INDEX IDX_5A6F91CE4CC8505A ON marque');
        $this->addSql('ALTER TABLE marque DROP offre_id');
        $this->addSql('ALTER TABLE offre ADD id_marque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F7C582423 FOREIGN KEY (id_marque) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F7C582423 ON offre (id_marque)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE numero_appel');
        $this->addSql('ALTER TABLE marque ADD offre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CE4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_5A6F91CE4CC8505A ON marque (offre_id)');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F7C582423');
        $this->addSql('DROP INDEX IDX_AF86866F7C582423 ON offre');
        $this->addSql('ALTER TABLE offre DROP id_marque');
    }
}
