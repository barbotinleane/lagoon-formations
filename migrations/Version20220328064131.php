<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328064131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD39926854E');
        $this->addSql('ALTER TABLE auto_entrepreneur DROP FOREIGN KEY FK_695933679926854E');
        $this->addSql('ALTER TABLE company_director DROP FOREIGN KEY FK_607C69D9926854E');
        $this->addSql('ALTER TABLE other_status DROP FOREIGN KEY FK_4A065F049926854E');
        $this->addSql('ALTER TABLE searching_job DROP FOREIGN KEY FK_2D88BDBD9926854E');
        $this->addSql('CREATE TABLE asks (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, formation_libelle_id INT NOT NULL, formation_session_id INT DEFAULT NULL, goal VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number INT NOT NULL, address VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, department VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, activity_category VARCHAR(255) DEFAULT NULL, handicap TINYINT(1) NOT NULL, prerequisites LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', knows_us LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_BB6C0B996BF700BD (status_id), INDEX IDX_BB6C0B99DD75E2B4 (formation_libelle_id), INDEX IDX_BB6C0B9999973FE6 (formation_session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asks ADD CONSTRAINT FK_BB6C0B996BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE asks ADD CONSTRAINT FK_BB6C0B99DD75E2B4 FOREIGN KEY (formation_libelle_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE asks ADD CONSTRAINT FK_BB6C0B9999973FE6 FOREIGN KEY (formation_session_id) REFERENCES formation_sessions (id)');
        $this->addSql('DROP TABLE artisan');
        $this->addSql('DROP TABLE auto_entrepreneur');
        $this->addSql('DROP TABLE company_director');
        $this->addSql('DROP TABLE formation_ask');
        $this->addSql('DROP TABLE other_status');
        $this->addSql('DROP TABLE searching_job');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artisan (id INT AUTO_INCREMENT NOT NULL, formation_ask_id INT NOT NULL, siren_or_rm VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, activity_category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, handicap TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_3C600AD39926854E (formation_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE auto_entrepreneur (id INT AUTO_INCREMENT NOT NULL, formation_ask_id INT NOT NULL, siret VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, activity_category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, handicap TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_695933679926854E (formation_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE company_director (id INT AUTO_INCREMENT NOT NULL, formation_ask_id INT NOT NULL, company_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, siren_or_rm VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, activity_category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_607C69D9926854E (formation_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formation_ask (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, session_id INT DEFAULT NULL, status_id INT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, goal VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number INT NOT NULL, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code INT DEFAULT NULL, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, department VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, knows_us VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, consents LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', INDEX IDX_DF768F945200282E (formation_id), INDEX IDX_DF768F94613FECDF (session_id), UNIQUE INDEX UNIQ_DF768F946BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE other_status (id INT AUTO_INCREMENT NOT NULL, formation_ask_id INT NOT NULL, handicap TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4A065F049926854E (formation_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE searching_job (id INT AUTO_INCREMENT NOT NULL, formation_ask_id INT NOT NULL, id_pole_emploi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, handicap TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2D88BDBD9926854E (formation_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD39926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('ALTER TABLE auto_entrepreneur ADD CONSTRAINT FK_695933679926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('ALTER TABLE company_director ADD CONSTRAINT FK_607C69D9926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('ALTER TABLE formation_ask ADD CONSTRAINT FK_DF768F945200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE formation_ask ADD CONSTRAINT FK_DF768F946BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE formation_ask ADD CONSTRAINT FK_DF768F94613FECDF FOREIGN KEY (session_id) REFERENCES formation_sessions (id)');
        $this->addSql('ALTER TABLE other_status ADD CONSTRAINT FK_4A065F049926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('ALTER TABLE searching_job ADD CONSTRAINT FK_2D88BDBD9926854E FOREIGN KEY (formation_ask_id) REFERENCES formation_ask (id)');
        $this->addSql('DROP TABLE asks');
    }
}
