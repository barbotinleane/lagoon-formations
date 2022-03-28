<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321142129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_sessions DROP FOREIGN KEY FK_5DF2CAE29CF0022');
        $this->addSql('DROP INDEX IDX_5DF2CAE29CF0022 ON formation_sessions');
        $this->addSql('ALTER TABLE formation_sessions DROP formation_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_sessions ADD formation_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation_sessions ADD CONSTRAINT FK_5DF2CAE29CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation_libelles (id)');
        $this->addSql('CREATE INDEX IDX_5DF2CAE29CF0022 ON formation_sessions (formation_id_id)');
    }
}
