<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240924091445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club_user DROP FOREIGN KEY FK_E95B1CA961190A32');
        $this->addSql('ALTER TABLE club_user DROP FOREIGN KEY FK_E95B1CA9A76ED395');
        $this->addSql('DROP TABLE club_user');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club_user (club_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E95B1CA961190A32 (club_id), INDEX IDX_E95B1CA9A76ED395 (user_id), PRIMARY KEY(club_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE club_user ADD CONSTRAINT FK_E95B1CA961190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_user ADD CONSTRAINT FK_E95B1CA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event CHANGE date date VARCHAR(255) NOT NULL');
    }
}
