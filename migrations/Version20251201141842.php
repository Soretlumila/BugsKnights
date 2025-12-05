<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251201141842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_details (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, cards_id INT NOT NULL, command_id INT NOT NULL, INDEX IDX_9D4C5869DC555177 (cards_id), INDEX IDX_9D4C586933E1689A (command_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE command_details ADD CONSTRAINT FK_9D4C5869DC555177 FOREIGN KEY (cards_id) REFERENCES cards (id)');
        $this->addSql('ALTER TABLE command_details ADD CONSTRAINT FK_9D4C586933E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_details DROP FOREIGN KEY FK_9D4C5869DC555177');
        $this->addSql('ALTER TABLE command_details DROP FOREIGN KEY FK_9D4C586933E1689A');
        $this->addSql('DROP TABLE command_details');
    }
}
