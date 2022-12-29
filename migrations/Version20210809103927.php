<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210809103927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD num INT NOT NULL, ADD cin INT NOT NULL, ADD paye VARCHAR(20) NOT NULL, ADD Auth INT DEFAULT NULL, ADD Code INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX num ON client (num)');
        $this->addSql('CREATE UNIQUE INDEX cin ON client (cin)');
        $this->addSql('CREATE UNIQUE INDEX email ON client (email)');
        $this->addSql('ALTER TABLE contrat ADD idclient INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_60349993A3F9A9F9 ON contrat (idclient)');
        $this->addSql('ALTER TABLE facture ADD idclient INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_FE866410A3F9A9F9 ON facture (idclient)');
        $this->addSql('ALTER TABLE logo ADD idClient INT DEFAULT NULL, CHANGE imlg imgLg VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_E48E9A13A455ACCF ON logo (idClient)');
        $this->addSql('ALTER TABLE reclamation ADD idclient INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_CE606404A3F9A9F9 ON reclamation (idclient)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY FK_E5562A2AA3F9A9F9');
        $this->addSql('DROP INDEX num ON client');
        $this->addSql('DROP INDEX cin ON client');
        $this->addSql('DROP INDEX email ON client');
        $this->addSql('ALTER TABLE client DROP prenom, DROP email, DROP num, DROP cin, DROP paye, DROP Auth, DROP Code');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993A3F9A9F9');
        $this->addSql('DROP INDEX IDX_60349993A3F9A9F9 ON contrat');
        $this->addSql('ALTER TABLE contrat DROP idclient');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A3F9A9F9');
        $this->addSql('DROP INDEX IDX_FE866410A3F9A9F9 ON facture');
        $this->addSql('ALTER TABLE facture DROP idclient');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A13A455ACCF');
        $this->addSql('DROP INDEX IDX_E48E9A13A455ACCF ON logo');
        $this->addSql('ALTER TABLE logo DROP idClient, CHANGE imglg imLg VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A3F9A9F9');
        $this->addSql('DROP INDEX IDX_CE606404A3F9A9F9 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP idclient');
    }
}
