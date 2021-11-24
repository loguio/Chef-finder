<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124130937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box ADD food_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AB3F04B2C FOREIGN KEY (food_category_id) REFERENCES food_category (id)');
        $this->addSql('CREATE INDEX IDX_8A9483AB3F04B2C ON box (food_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483AB3F04B2C');
        $this->addSql('DROP INDEX IDX_8A9483AB3F04B2C ON box');
        $this->addSql('ALTER TABLE box DROP food_category_id');
    }
}
