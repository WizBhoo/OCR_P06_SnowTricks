<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422093641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE snowboarder (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(30) NOT NULL, first_name VARCHAR(30) NOT NULL, pseudo VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, account_token VARCHAR(255) DEFAULT NULL, account_token_at DATETIME DEFAULT NULL, account_status TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8F965D8686CC499D (pseudo), UNIQUE INDEX UNIQ_8F965D86E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, figure_id_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2C6D69186E (figure_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, figure_id_id INT NOT NULL, snowboarder_id_id INT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C6D69186E (figure_id_id), INDEX IDX_9474526C8F546CB1 (snowboarder_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, figure_id_id INT NOT NULL, is_primary TINYINT(1) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_C53D045F6D69186E (figure_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, snowboarder_id_id INT NOT NULL, category_id_id INT NOT NULL, slug VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2F57B37A8F546CB1 (snowboarder_id_id), INDEX IDX_2F57B37A9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C6D69186E FOREIGN KEY (figure_id_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6D69186E FOREIGN KEY (figure_id_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C8F546CB1 FOREIGN KEY (snowboarder_id_id) REFERENCES snowboarder (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6D69186E FOREIGN KEY (figure_id_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A8F546CB1 FOREIGN KEY (snowboarder_id_id) REFERENCES snowboarder (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C8F546CB1');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A8F546CB1');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A9777D11E');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C6D69186E');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6D69186E');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6D69186E');
        $this->addSql('DROP TABLE snowboarder');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE figure');
    }
}
