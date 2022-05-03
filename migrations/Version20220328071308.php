<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328071308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asks_stagiaires (asks_id INT NOT NULL, stagiaires_id INT NOT NULL, INDEX IDX_1823C57C3373B24C (asks_id), INDEX IDX_1823C57CBBA93DD6 (stagiaires_id), PRIMARY KEY(asks_id, stagiaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asks_stagiaires ADD CONSTRAINT FK_1823C57C3373B24C FOREIGN KEY (asks_id) REFERENCES asks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asks_stagiaires ADD CONSTRAINT FK_1823C57CBBA93DD6 FOREIGN KEY (stagiaires_id) REFERENCES stagiaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asks ADD company_name VARCHAR(255) DEFAULT NULL, ADD siren_or_rm VARCHAR(255) DEFAULT NULL, ADD siret VARCHAR(255) DEFAULT NULL, ADD id_pole_emploi VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE asks_stagiaire');
        $this->addSql('ALTER TABLE asks DROP company_name, DROP siren_or_rm, DROP siret, DROP id_pole_emploi');
    }
}
