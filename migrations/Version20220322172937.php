<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322172937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan ADD formation_ask_id INT NOT NULL');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD39926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C600AD39926854E ON artisan (formation_ask_id)');
        $this->addSql('ALTER TABLE auto_entrepreneur ADD formation_ask_id INT NOT NULL');
        $this->addSql('ALTER TABLE auto_entrepreneur ADD CONSTRAINT FK_695933679926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_695933679926854E ON auto_entrepreneur (formation_ask_id)');
        $this->addSql('ALTER TABLE company_director ADD formation_ask_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_director ADD CONSTRAINT FK_607C69D9926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_607C69D9926854E ON company_director (formation_ask_id)');
        $this->addSql('ALTER TABLE formation_ask ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation_ask ADD CONSTRAINT FK_DF768F946BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DF768F946BF700BD ON formation_ask (status_id)');
        $this->addSql('ALTER TABLE other_status ADD formation_ask_id INT NOT NULL');
        $this->addSql('ALTER TABLE other_status ADD CONSTRAINT FK_4A065F049926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A065F049926854E ON other_status (formation_ask_id)');
        $this->addSql('ALTER TABLE searching_job ADD formation_ask_id INT NOT NULL');
        $this->addSql('ALTER TABLE searching_job ADD CONSTRAINT FK_2D88BDBD9926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D88BDBD9926854E ON searching_job (formation_ask_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD39926854E');
        $this->addSql('DROP INDEX UNIQ_3C600AD39926854E ON artisan');
        $this->addSql('ALTER TABLE artisan DROP formation_ask_id');
        $this->addSql('ALTER TABLE auto_entrepreneur DROP FOREIGN KEY FK_695933679926854E');
        $this->addSql('DROP INDEX UNIQ_695933679926854E ON auto_entrepreneur');
        $this->addSql('ALTER TABLE auto_entrepreneur DROP formation_ask_id');
        $this->addSql('ALTER TABLE company_director DROP FOREIGN KEY FK_607C69D9926854E');
        $this->addSql('DROP INDEX UNIQ_607C69D9926854E ON company_director');
        $this->addSql('ALTER TABLE company_director DROP formation_ask_id');
        $this->addSql('ALTER TABLE formation_ask DROP FOREIGN KEY FK_DF768F946BF700BD');
        $this->addSql('DROP INDEX UNIQ_DF768F946BF700BD ON formation_ask');
        $this->addSql('ALTER TABLE formation_ask DROP status_id');
        $this->addSql('ALTER TABLE other_status DROP FOREIGN KEY FK_4A065F049926854E');
        $this->addSql('DROP INDEX UNIQ_4A065F049926854E ON other_status');
        $this->addSql('ALTER TABLE other_status DROP formation_ask_id');
        $this->addSql('ALTER TABLE searching_job DROP FOREIGN KEY FK_2D88BDBD9926854E');
        $this->addSql('DROP INDEX UNIQ_2D88BDBD9926854E ON searching_job');
        $this->addSql('ALTER TABLE searching_job DROP formation_ask_id');
    }
}
