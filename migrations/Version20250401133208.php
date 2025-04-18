<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250401133208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE marqueur_filtre DROP FOREIGN KEY FK_6C471940FF20052F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE marqueur_filtre DROP FOREIGN KEY FK_6C471940CC9B96EA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE filtre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE marqueur_filtre
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE filtre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE marqueur_filtre (filtre_id INT NOT NULL, marqueur_id INT NOT NULL, INDEX IDX_6C471940FF20052F (marqueur_id), INDEX IDX_6C471940CC9B96EA (filtre_id), PRIMARY KEY(filtre_id, marqueur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE marqueur_filtre ADD CONSTRAINT FK_6C471940FF20052F FOREIGN KEY (marqueur_id) REFERENCES marqueur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE marqueur_filtre ADD CONSTRAINT FK_6C471940CC9B96EA FOREIGN KEY (filtre_id) REFERENCES filtre (id) ON DELETE CASCADE
        SQL);
    }
}
