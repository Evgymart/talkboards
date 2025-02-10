<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210204201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Board consists of posts, posts created by users';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA board');
        $this->addSql('CREATE TABLE board.board (board_id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(board_id))');
        $this->addSql('COMMENT ON COLUMN board.board.created_at IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE board.board');
        $this->addSql('DROP SCHEMA board');
    }
}
