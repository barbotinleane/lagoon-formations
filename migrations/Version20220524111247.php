<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524111247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asks_stagiaire DROP FOREIGN KEY FK_1823C57CBBA93DD6');
        $this->addSql('DROP TABLE asks_stagiaire');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('ALTER TABLE asks_stagiaires ADD CONSTRAINT FK_42A5D1D93373B24C FOREIGN KEY (asks_id) REFERENCES asks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asks_stagiaires ADD CONSTRAINT FK_42A5D1D9887A63F9 FOREIGN KEY (stagiaires_id) REFERENCES stagiaires (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asks_stagiaire (asks_id INT NOT NULL, stagiaire_id INT NOT NULL, INDEX IDX_1823C57C3373B24C (asks_id), INDEX IDX_1823C57CBBA93DD6 (stagiaire_id), PRIMARY KEY(asks_id, stagiaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stagiaire (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number INT DEFAULT NULL, current_job VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, handicap TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE asks_stagiaire ADD CONSTRAINT FK_1823C57C3373B24C FOREIGN KEY (asks_id) REFERENCES asks (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asks_stagiaire ADD CONSTRAINT FK_1823C57CBBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asks_stagiaires DROP FOREIGN KEY FK_42A5D1D93373B24C');
        $this->addSql('ALTER TABLE asks_stagiaires DROP FOREIGN KEY FK_42A5D1D9887A63F9');
    }
}
