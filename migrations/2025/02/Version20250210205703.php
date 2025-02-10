<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210205703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Posts created by users';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board.post (post_id UUID NOT NULL, board_id UUID NOT NULL, user_id UUID NOT NULL, title VARCHAR(255) NOT NULL, text TEXT NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(post_id, board_id))');
        $this->addSql('COMMENT ON COLUMN board.post.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN board.post.updated_at IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE board.post');
    }
}
