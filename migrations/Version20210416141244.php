<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416141244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD id_audience_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3319C9E0BE1 FOREIGN KEY (id_audience_id) REFERENCES audience (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A3319C9E0BE1 ON book (id_audience_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3319C9E0BE1');
        $this->addSql('DROP INDEX IDX_CBE5A3319C9E0BE1 ON book');
        $this->addSql('ALTER TABLE book DROP id_audience_id');
    }
}
