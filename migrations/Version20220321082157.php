<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321082157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_asks ADD formation_id INT NOT NULL, ADD session_id INT NOT NULL, ADD status VARCHAR(255) DEFAULT NULL, ADD goal VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD phone_number INT NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD postal_code INT NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD department VARCHAR(255) DEFAULT NULL, ADD department_code INT DEFAULT NULL, ADD country VARCHAR(255) NOT NULL, ADD activity_category VARCHAR(255) DEFAULT NULL, ADD handicap TINYINT(1) NOT NULL, ADD prerequisite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', ADD formation_known VARCHAR(255) DEFAULT NULL, ADD consents LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED95200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED9613FECDF FOREIGN KEY (session_id) REFERENCES formation_sessions (id)');
        $this->addSql('CREATE INDEX IDX_ECB3EED95200282E ON formation_asks (formation_id)');
        $this->addSql('CREATE INDEX IDX_ECB3EED9613FECDF ON formation_asks (session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_asks DROP FOREIGN KEY FK_ECB3EED95200282E');
        $this->addSql('ALTER TABLE formation_asks DROP FOREIGN KEY FK_ECB3EED9613FECDF');
        $this->addSql('DROP INDEX IDX_ECB3EED95200282E ON formation_asks');
        $this->addSql('DROP INDEX IDX_ECB3EED9613FECDF ON formation_asks');
        $this->addSql('ALTER TABLE formation_asks DROP formation_id, DROP session_id, DROP status, DROP goal, DROP email, DROP phone_number, DROP address, DROP postal_code, DROP city, DROP department, DROP department_code, DROP country, DROP activity_category, DROP handicap, DROP prerequisite, DROP formation_known, DROP consents');
    }
}
