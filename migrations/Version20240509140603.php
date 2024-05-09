<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509140603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activation_platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(26) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offers ADD platform_id INT DEFAULT NULL, ADD activation_platform_id INT DEFAULT NULL, ADD discount VARCHAR(5) DEFAULT NULL, ADD edition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604272999F033 FOREIGN KEY (activation_platform_id) REFERENCES activation_platform (id)');
        $this->addSql('CREATE INDEX IDX_DA460427FFE6496F ON offers (platform_id)');
        $this->addSql('CREATE INDEX IDX_DA4604272999F033 ON offers (activation_platform_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604272999F033');
        $this->addSql('DROP TABLE activation_platform');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427FFE6496F');
        $this->addSql('DROP INDEX IDX_DA460427FFE6496F ON offers');
        $this->addSql('DROP INDEX IDX_DA4604272999F033 ON offers');
        $this->addSql('ALTER TABLE offers DROP platform_id, DROP activation_platform_id, DROP discount, DROP edition');
    }
}
