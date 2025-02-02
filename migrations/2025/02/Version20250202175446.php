<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202175446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating the table for the board entity. Each board is a personal themed space for online conversations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE board');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board (id UUID NOT NULL, name UUID NOT NULL, description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN board.id IS \'(DC2Type:TalkBoards\Infrastructure\UuidDoctrine\UuidType)\'');
        $this->addSql('COMMENT ON COLUMN board.name IS \'(DC2Type:TalkBoards\Infrastructure\UuidDoctrine\UuidType)\'');
        $this->addSql('COMMENT ON COLUMN board.created_at IS \'(DC2Type:datetimetz_immutable)\'');
    }
}
