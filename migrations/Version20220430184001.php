<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220430184001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_chief ADD roles JSON NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FFBD7514E7927C74 ON user_chief (email)');
        $this->addSql('ALTER TABLE user_customer ADD roles JSON NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_61B46A09E7927C74 ON user_customer (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_FFBD7514E7927C74 ON user_chief');
        $this->addSql('ALTER TABLE user_chief DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_61B46A09E7927C74 ON user_customer');
        $this->addSql('ALTER TABLE user_customer DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
    }
}
