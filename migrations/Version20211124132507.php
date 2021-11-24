<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124132507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE box_product (box_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_CA889A9CD8177B3F (box_id), INDEX IDX_CA889A9C4584665A (product_id), PRIMARY KEY(box_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE box_product ADD CONSTRAINT FK_CA889A9CD8177B3F FOREIGN KEY (box_id) REFERENCES box (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE box_product ADD CONSTRAINT FK_CA889A9C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking ADD box_id INT NOT NULL, ADD chief_id INT NOT NULL, ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED8177B3F FOREIGN KEY (box_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE7A7B68E1 FOREIGN KEY (chief_id) REFERENCES user_chief (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES user_customer (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDED8177B3F ON booking (box_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE7A7B68E1 ON booking (chief_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9395C3F3 ON booking (customer_id)');
        $this->addSql('ALTER TABLE live ADD user_chief_id INT NOT NULL');
        $this->addSql('ALTER TABLE live ADD CONSTRAINT FK_530F2CAF9AF68CE1 FOREIGN KEY (user_chief_id) REFERENCES user_chief (id)');
        $this->addSql('CREATE INDEX IDX_530F2CAF9AF68CE1 ON live (user_chief_id)');
        $this->addSql('ALTER TABLE live_viewer ADD live_id INT NOT NULL');
        $this->addSql('ALTER TABLE live_viewer ADD CONSTRAINT FK_600A1A811DEBA901 FOREIGN KEY (live_id) REFERENCES live (id)');
        $this->addSql('CREATE INDEX IDX_600A1A811DEBA901 ON live_viewer (live_id)');
        $this->addSql('ALTER TABLE `order` ADD booking_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993983301C60 ON `order` (booking_id)');
        $this->addSql('ALTER TABLE user_customer ADD live_viewer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_customer ADD CONSTRAINT FK_61B46A09D64EA722 FOREIGN KEY (live_viewer_id) REFERENCES live_viewer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_61B46A09D64EA722 ON user_customer (live_viewer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE box_product');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDED8177B3F');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE7A7B68E1');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('DROP INDEX IDX_E00CEDDED8177B3F ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE7A7B68E1 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE9395C3F3 ON booking');
        $this->addSql('ALTER TABLE booking DROP box_id, DROP chief_id, DROP customer_id');
        $this->addSql('ALTER TABLE live DROP FOREIGN KEY FK_530F2CAF9AF68CE1');
        $this->addSql('DROP INDEX IDX_530F2CAF9AF68CE1 ON live');
        $this->addSql('ALTER TABLE live DROP user_chief_id');
        $this->addSql('ALTER TABLE live_viewer DROP FOREIGN KEY FK_600A1A811DEBA901');
        $this->addSql('DROP INDEX IDX_600A1A811DEBA901 ON live_viewer');
        $this->addSql('ALTER TABLE live_viewer DROP live_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993983301C60');
        $this->addSql('DROP INDEX UNIQ_F52993983301C60 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP booking_id');
        $this->addSql('ALTER TABLE user_customer DROP FOREIGN KEY FK_61B46A09D64EA722');
        $this->addSql('DROP INDEX UNIQ_61B46A09D64EA722 ON user_customer');
        $this->addSql('ALTER TABLE user_customer DROP live_viewer_id');
    }
}
