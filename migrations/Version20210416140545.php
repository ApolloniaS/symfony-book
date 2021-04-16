<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416140545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review ADD id_book_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_794381C6C83F1AF1 ON review (id_book_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6C83F1AF1');
        $this->addSql('DROP INDEX IDX_794381C6C83F1AF1 ON review');
        $this->addSql('ALTER TABLE review DROP id_book_id');
    }
}
