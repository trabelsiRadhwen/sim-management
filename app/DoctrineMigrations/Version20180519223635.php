<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180519223635 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC210C80EDDAD');
        $this->addSql('DROP INDEX IDX_2ECAC210C80EDDAD ON sim');
        $this->addSql('ALTER TABLE sim ADD agent_id INT DEFAULT NULL, CHANGE id_agent offre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC2104CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC2103414710B FOREIGN KEY (agent_id) REFERENCES agent_commercial (id)');
        $this->addSql('CREATE INDEX IDX_2ECAC2104CC8505A ON sim (offre_id)');
        $this->addSql('CREATE INDEX IDX_2ECAC2103414710B ON sim (agent_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC2104CC8505A');
        $this->addSql('ALTER TABLE sim DROP FOREIGN KEY FK_2ECAC2103414710B');
        $this->addSql('DROP INDEX IDX_2ECAC2104CC8505A ON sim');
        $this->addSql('DROP INDEX IDX_2ECAC2103414710B ON sim');
        $this->addSql('ALTER TABLE sim ADD id_agent INT DEFAULT NULL, DROP offre_id, DROP agent_id');
        $this->addSql('ALTER TABLE sim ADD CONSTRAINT FK_2ECAC210C80EDDAD FOREIGN KEY (id_agent) REFERENCES agent_commercial (id)');
        $this->addSql('CREATE INDEX IDX_2ECAC210C80EDDAD ON sim (id_agent)');
    }
}
