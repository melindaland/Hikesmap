<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402085014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE notation DROP FOREIGN KEY FK_268BC956E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notation
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE notation (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, note INT NOT NULL, INDEX IDX_268BC956E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation ADD CONSTRAINT FK_268BC956E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
    }
}
