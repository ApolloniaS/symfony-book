<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503081716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3314EAFAD8B');
        $this->addSql('DROP INDEX IDX_CBE5A3314EAFAD8B ON book');
        $this->addSql('ALTER TABLE book DROP user_book_id');
        $this->addSql('ALTER TABLE user_book ADD id_book_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF8C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_B164EFF8C83F1AF1 ON user_book (id_book_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD user_book_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3314EAFAD8B FOREIGN KEY (user_book_id) REFERENCES user_book (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A3314EAFAD8B ON book (user_book_id)');
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF8C83F1AF1');
        $this->addSql('DROP INDEX IDX_B164EFF8C83F1AF1 ON user_book');
        $this->addSql('ALTER TABLE user_book DROP id_book_id');
    }
}
