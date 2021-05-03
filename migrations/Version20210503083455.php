<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503083455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_author (id INT AUTO_INCREMENT NOT NULL, id_author_id INT NOT NULL, id_book_id INT NOT NULL, INDEX IDX_9478D34576404F3C (id_author_id), INDEX IDX_9478D345C83F1AF1 (id_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34576404F3C FOREIGN KEY (id_author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_author');
    }
}
