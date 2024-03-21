<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321120106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE score score INT DEFAULT NULL, CHANGE date_time date_time DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_payment CHANGE date_time date_time DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_payment CHANGE date_time date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE score score INT NOT NULL, CHANGE date_time date_time DATETIME NOT NULL');
    }
}
