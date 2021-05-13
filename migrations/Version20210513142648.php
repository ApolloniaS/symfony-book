<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513142648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audience (id INT AUTO_INCREMENT NOT NULL, audience_group VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, id_audience_id INT DEFAULT NULL, picture VARCHAR(150) DEFAULT NULL, title VARCHAR(100) NOT NULL, summary VARCHAR(255) NOT NULL, first_release DATE DEFAULT NULL, INDEX IDX_CBE5A3319C9E0BE1 (id_audience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (id INT AUTO_INCREMENT NOT NULL, id_author_id INT NOT NULL, id_book_id INT NOT NULL, INDEX IDX_9478D34576404F3C (id_author_id), INDEX IDX_9478D345C83F1AF1 (id_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_category (id INT AUTO_INCREMENT NOT NULL, id_book_id INT NOT NULL, id_category_id INT NOT NULL, INDEX IDX_1FB30F98C83F1AF1 (id_book_id), INDEX IDX_1FB30F98A545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_book_id INT DEFAULT NULL, review_date DATE NOT NULL, review_content VARCHAR(255) NOT NULL, review_score DOUBLE PRECISION NOT NULL, INDEX IDX_794381C679F37AE5 (id_user_id), INDEX IDX_794381C6C83F1AF1 (id_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(323) NOT NULL, is_admin TINYINT(1) DEFAULT NULL, birthdate DATE NOT NULL, avatar VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_book (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_book_id INT NOT NULL, reading_status VARCHAR(50) NOT NULL, INDEX IDX_B164EFF879F37AE5 (id_user_id), INDEX IDX_B164EFF8C83F1AF1 (id_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3319C9E0BE1 FOREIGN KEY (id_audience_id) REFERENCES audience (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34576404F3C FOREIGN KEY (id_author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF8C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3319C9E0BE1');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34576404F3C');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345C83F1AF1');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F98C83F1AF1');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6C83F1AF1');
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF8C83F1AF1');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F98A545015');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C679F37AE5');
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF879F37AE5');
        $this->addSql('DROP TABLE audience');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE book_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_book');
    }
}
