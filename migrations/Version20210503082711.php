<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503082711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_category (id INT AUTO_INCREMENT NOT NULL, id_book_id INT NOT NULL, id_category_id INT NOT NULL, INDEX IDX_1FB30F98C83F1AF1 (id_book_id), INDEX IDX_1FB30F98A545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_category');
    }
}
