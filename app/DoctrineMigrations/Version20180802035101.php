<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180802035101 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE broadcasts CHANGE user_id user_id INT DEFAULT NULL, CHANGE convey_id convey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE convey_users_role CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE convey_id convey_id INT DEFAULT NULL, CHANGE role_id role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE locations CHANGE user_id user_id INT DEFAULT NULL, CHANGE convey_id convey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messages CHANGE from_id from_id INT DEFAULT NULL, CHANGE to_id to_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE places CHANGE convey_id convey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE convey_id convey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE mobile mobile TEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE broadcasts CHANGE user_id user_id INT NOT NULL, CHANGE convey_id convey_id INT NOT NULL');
        $this->addSql('ALTER TABLE convey_users_role CHANGE id id INT NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE convey_id convey_id INT NOT NULL, CHANGE role_id role_id INT NOT NULL');
        $this->addSql('ALTER TABLE locations CHANGE user_id user_id INT NOT NULL, CHANGE convey_id convey_id INT NOT NULL');
        $this->addSql('ALTER TABLE messages CHANGE from_id from_id INT NOT NULL, CHANGE to_id to_id INT NOT NULL');
        $this->addSql('ALTER TABLE places CHANGE convey_id convey_id INT NOT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE convey_id convey_id INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE mobile mobile VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
    }
}
