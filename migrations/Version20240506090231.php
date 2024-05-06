<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506090231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nplateforms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nplateforms_game (nplateforms_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_EE0B3F94D5E5CFC4 (nplateforms_id), INDEX IDX_EE0B3F94E48FD905 (game_id), PRIMARY KEY(nplateforms_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nplateforms_game ADD CONSTRAINT FK_EE0B3F94D5E5CFC4 FOREIGN KEY (nplateforms_id) REFERENCES nplateforms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nplateforms_game ADD CONSTRAINT FK_EE0B3F94E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nplateforms_game DROP FOREIGN KEY FK_EE0B3F94D5E5CFC4');
        $this->addSql('ALTER TABLE nplateforms_game DROP FOREIGN KEY FK_EE0B3F94E48FD905');
        $this->addSql('DROP TABLE nplateforms');
        $this->addSql('DROP TABLE nplateforms_game');
    }
}
