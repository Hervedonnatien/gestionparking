<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116115025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chauffeur ADD num_parking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chauffeur ADD CONSTRAINT FK_5CA777B88000F256 FOREIGN KEY (num_parking_id) REFERENCES parking (id)');
        $this->addSql('CREATE INDEX IDX_5CA777B88000F256 ON chauffeur (num_parking_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chauffeur DROP FOREIGN KEY FK_5CA777B88000F256');
        $this->addSql('DROP INDEX IDX_5CA777B88000F256 ON chauffeur');
        $this->addSql('ALTER TABLE chauffeur DROP num_parking_id');
    }
}
