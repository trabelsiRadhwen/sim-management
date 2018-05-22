<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180519141303 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC2107C582423');
        $this->addSql('DROP INDEX IDX_2ECAC2107C582423 ON sim');
        $this->addSql('ALTER TABLE sim CHANGE id_marque marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC2104827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_2ECAC2104827B9B2 ON sim (marque_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC2104827B9B2');
        $this->addSql('DROP INDEX IDX_2ECAC2104827B9B2 ON sim');
        $this->addSql('ALTER TABLE sim CHANGE marque_id id_marque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC2107C582423 FOREIGN KEY (id_marque) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_2ECAC2107C582423 ON sim (id_marque)');
    }
}
