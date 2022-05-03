<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322171933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE stagiaires (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number INT DEFAULT NULL, current_job VARCHAR(255) DEFAULT NULL, handicap TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_sessions ADD formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation_sessions ADD CONSTRAINT FK_5DF2CAE25200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('CREATE INDEX IDX_5DF2CAE25200282E ON formation_sessions (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_asks (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, session_id INT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, goal VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number INT NOT NULL, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code INT NOT NULL, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, department VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, department_code INT DEFAULT NULL, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, activity_category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, handicap TINYINT(1) NOT NULL, prerequisite LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', formation_known VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, consents LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', company_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, siren_or_rm VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, workers LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', siret VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, id_pole_emploi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_ECB3EED9613FECDF (session_id), INDEX IDX_ECB3EED95200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED9613FECDF FOREIGN KEY (session_id) REFERENCES formation_sessions (id)');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED95200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('DROP TABLE artisan');
        $this->addSql('DROP TABLE auto_entrepreneur');
        $this->addSql('DROP TABLE company_director');
        $this->addSql('DROP TABLE formation_ask');
        $this->addSql('DROP TABLE other_status');
        $this->addSql('DROP TABLE searching_job');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('ALTER TABLE formation_sessions DROP FOREIGN KEY FK_5DF2CAE25200282E');
        $this->addSql('DROP INDEX IDX_5DF2CAE25200282E ON formation_sessions');
    }
}
