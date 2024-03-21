<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320122230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE master_payment (id INT AUTO_INCREMENT NOT NULL, payment_label VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, localization VARCHAR(255) DEFAULT NULL, gps_location VARCHAR(50) NOT NULL, date_time DATETIME NOT NULL, user_id VARCHAR(36) NOT NULL, INDEX IDX_B10F6965A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_payment (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, gps_location VARCHAR(50) NOT NULL, amount INT NOT NULL, currency VARCHAR(10) NOT NULL, status VARCHAR(10) NOT NULL, remarks VARCHAR(255) DEFAULT NULL, date_time DATETIME NOT NULL, user_id VARCHAR(36) NOT NULL, payment_id INT DEFAULT NULL, INDEX IDX_35259A07A76ED395 (user_id), UNIQUE INDEX UNIQ_35259A074C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE master_payment ADD CONSTRAINT FK_B10F6965A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_payment ADD CONSTRAINT FK_35259A07A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_payment ADD CONSTRAINT FK_35259A074C3A3BB FOREIGN KEY (payment_id) REFERENCES user_payment (id)');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(100) DEFAULT NULL, ADD last_name VARCHAR(100) DEFAULT NULL, ADD score INT NOT NULL, ADD date_time DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE master_payment DROP FOREIGN KEY FK_B10F6965A76ED395');
        $this->addSql('ALTER TABLE user_payment DROP FOREIGN KEY FK_35259A07A76ED395');
        $this->addSql('ALTER TABLE user_payment DROP FOREIGN KEY FK_35259A074C3A3BB');
        $this->addSql('DROP TABLE master_payment');
        $this->addSql('DROP TABLE user_payment');
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP score, DROP date_time');
    }
}
