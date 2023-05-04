<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504152100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, region_code VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, answer LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_asks (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, formation_libelle_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, knows_us LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', company_name VARCHAR(255) DEFAULT NULL, company_postal_code INT DEFAULT NULL, number_of_learners INT DEFAULT NULL, INDEX IDX_ECB3EED96BF700BD (status_id), INDEX IDX_ECB3EED9DD75E2B4 (formation_libelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_goals (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, goal LONGTEXT NOT NULL, INDEX IDX_B1AF805A5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_images (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, INDEX IDX_C006B0475200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_libelles (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, agrement TINYINT(1) NOT NULL, duration VARCHAR(255) NOT NULL, cost INT NOT NULL, program_name VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, place VARCHAR(255) DEFAULT NULL, satisfaction_rate INT DEFAULT NULL, individual_success_rate INT DEFAULT NULL, company_approval_rate INT DEFAULT NULL, INDEX IDX_CE8FA7AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_prices (id INT AUTO_INCREMENT NOT NULL, number_of_people INT DEFAULT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_sessions (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, registered INT DEFAULT NULL, capacity INT NOT NULL, INDEX IDX_5DF2CAE25200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, content LONGTEXT NOT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pool_color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pool_shape (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_ask (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone INT NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, department VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, water_surface VARCHAR(255) DEFAULT NULL, shape VARCHAR(255) NOT NULL, pool_model VARCHAR(255) DEFAULT NULL, pool_color VARCHAR(255) NOT NULL, beach VARCHAR(255) NOT NULL, beach_size VARCHAR(255) DEFAULT NULL, beach_color VARCHAR(255) DEFAULT NULL, filtration_type VARCHAR(255) DEFAULT NULL, heat_pump VARCHAR(255) NOT NULL, building_starts VARCHAR(255) NOT NULL, budget VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stagiaires (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, handicap TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED96BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE formation_asks ADD CONSTRAINT FK_ECB3EED9DD75E2B4 FOREIGN KEY (formation_libelle_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE formation_goals ADD CONSTRAINT FK_B1AF805A5200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE formation_images ADD CONSTRAINT FK_C006B0475200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
        $this->addSql('ALTER TABLE formation_libelles ADD CONSTRAINT FK_CE8FA7AD12469DE2 FOREIGN KEY (category_id) REFERENCES formation_category (id)');
        $this->addSql('ALTER TABLE formation_sessions ADD CONSTRAINT FK_5DF2CAE25200282E FOREIGN KEY (formation_id) REFERENCES formation_libelles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_asks DROP FOREIGN KEY FK_ECB3EED96BF700BD');
        $this->addSql('ALTER TABLE formation_asks DROP FOREIGN KEY FK_ECB3EED9DD75E2B4');
        $this->addSql('ALTER TABLE formation_goals DROP FOREIGN KEY FK_B1AF805A5200282E');
        $this->addSql('ALTER TABLE formation_images DROP FOREIGN KEY FK_C006B0475200282E');
        $this->addSql('ALTER TABLE formation_libelles DROP FOREIGN KEY FK_CE8FA7AD12469DE2');
        $this->addSql('ALTER TABLE formation_sessions DROP FOREIGN KEY FK_5DF2CAE25200282E');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE formation_asks');
        $this->addSql('DROP TABLE formation_category');
        $this->addSql('DROP TABLE formation_goals');
        $this->addSql('DROP TABLE formation_images');
        $this->addSql('DROP TABLE formation_libelles');
        $this->addSql('DROP TABLE formation_prices');
        $this->addSql('DROP TABLE formation_sessions');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE pool_color');
        $this->addSql('DROP TABLE pool_shape');
        $this->addSql('DROP TABLE project_ask');
        $this->addSql('DROP TABLE stagiaires');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
