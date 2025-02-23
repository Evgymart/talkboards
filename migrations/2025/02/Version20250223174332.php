<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250223174332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA board');
        $this->addSql('CREATE SCHEMA userspace');
        $this->addSql('CREATE TABLE board.board (board_id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(board_id))');
        $this->addSql('COMMENT ON COLUMN board.board.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE board.post (post_id UUID NOT NULL, board_id UUID NOT NULL, user_id UUID NOT NULL, title VARCHAR(255) NOT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(post_id, board_id))');
        $this->addSql('COMMENT ON COLUMN board.post.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN board.post.updated_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE userspace."user" (user_id UUID NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(user_id))');
        $this->addSql('COMMENT ON COLUMN userspace."user".created_at IS \'(DC2Type:datetimetz_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE board.board');
        $this->addSql('DROP TABLE board.post');
        $this->addSql('DROP TABLE userspace."user"');
        $this->addSql('DROP SCHEMA board');
        $this->addSql('DROP SCHEMA userspace');
    }
}
