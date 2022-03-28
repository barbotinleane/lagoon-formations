<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307125910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_libelles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, agrement TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, cost INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_sessions (id INT AUTO_INCREMENT NOT NULL, formation_id_id INT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, registered INT DEFAULT NULL, capacity INT NOT NULL, INDEX IDX_5DF2CAE29CF0022 (formation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_sessions ADD CONSTRAINT FK_5DF2CAE29CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation_libelles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_sessions DROP FOREIGN KEY FK_5DF2CAE29CF0022');
        $this->addSql('DROP TABLE formation_libelles');
        $this->addSql('DROP TABLE formation_sessions');
    }
}
