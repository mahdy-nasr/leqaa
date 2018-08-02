<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180802180640 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE places');
        $this->addSql('ALTER TABLE users ADD role INT NOT NULL, DROP $location');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, convey_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_general_ci, `long` VARCHAR(255) NOT NULL COLLATE utf8_general_ci, lat VARCHAR(255) NOT NULL COLLATE utf8_general_ci, INDEX places_fk0 (convey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT places_fk0 FOREIGN KEY (convey_id) REFERENCES convey (id)');
        $this->addSql('ALTER TABLE users ADD $location VARCHAR(255) NOT NULL COLLATE utf8_general_ci, DROP role');
    }
}
