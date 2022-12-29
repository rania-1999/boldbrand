<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811155457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX cin ON client');
        $this->addSql('ALTER TABLE client DROP cin');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY FK_E5562A2AA3F9A9F9');
        $this->addSql('ALTER TABLE client ADD cin INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX cin ON client (cin)');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993A3F9A9F9');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A3F9A9F9');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A13A455ACCF');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A3F9A9F9');
    }
}
