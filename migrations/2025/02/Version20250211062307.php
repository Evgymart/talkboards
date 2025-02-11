<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211062307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'A table for users. Users do not need to register. Used for convenience';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA userspace');
        $this->addSql('CREATE TABLE userspace."user" (user_id UUID NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(user_id))');
        $this->addSql('COMMENT ON COLUMN userspace."user".created_at IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE userspace."user"');
        $this->addSql('DROP SCHEMA userspace');
    }
}
