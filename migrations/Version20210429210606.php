<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210429210606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gadget (id INT AUTO_INCREMENT NOT NULL, sample_picture VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joke (id INT AUTO_INCREMENT NOT NULL, setup VARCHAR(255) DEFAULT NULL, punchline VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_gadget (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) DEFAULT NULL, size VARCHAR(255) DEFAULT NULL, size_details VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATE DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, gadget_id INT DEFAULT NULL, option_gadget_id INT DEFAULT NULL, joke_id INT DEFAULT NULL, order_made_id INT DEFAULT NULL, quantity INT DEFAULT NULL, INDEX IDX_ED896F4684CDDC26 (gadget_id), INDEX IDX_ED896F465556CCA6 (option_gadget_id), INDEX IDX_ED896F4630122C15 (joke_id), INDEX IDX_ED896F46BB954D71 (order_made_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F4684CDDC26 FOREIGN KEY (gadget_id) REFERENCES gadget (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F465556CCA6 FOREIGN KEY (option_gadget_id) REFERENCES option_gadget (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F4630122C15 FOREIGN KEY (joke_id) REFERENCES joke (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46BB954D71 FOREIGN KEY (order_made_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F4684CDDC26');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F4630122C15');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F465556CCA6');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46BB954D71');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE gadget');
        $this->addSql('DROP TABLE joke');
        $this->addSql('DROP TABLE option_gadget');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE user');
    }
}
