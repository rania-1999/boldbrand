<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727094535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX pseudo ON client');
        $this->addSql('ALTER TABLE client ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP pseudo, DROP pass');
        $this->addSql('CREATE UNIQUE INDEX username ON client (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX username ON client');
        $this->addSql('ALTER TABLE client ADD pseudo VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, ADD pass VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, DROP username, DROP password');
        $this->addSql('CREATE UNIQUE INDEX pseudo ON client (pseudo)');
    }
}
