<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116112213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parking ADD num_voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parking ADD CONSTRAINT FK_B237527A8E96E831 FOREIGN KEY (num_voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_B237527A8E96E831 ON parking (num_voiture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parking DROP FOREIGN KEY FK_B237527A8E96E831');
        $this->addSql('DROP INDEX IDX_B237527A8E96E831 ON parking');
        $this->addSql('ALTER TABLE parking DROP num_voiture_id');
    }
}
