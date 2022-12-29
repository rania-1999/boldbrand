<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824225626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY chart_ibfk_1');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2AA3F9A9F9 FOREIGN KEY (idclient) REFERENCES client (idCl)');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY contrat_ibfk_1');
        $this->addSql('ALTER TABLE contrat CHANGE docCtr docCtr VARCHAR(255) NOT NULL, CHANGE docBonLiv docBonLiv VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993A3F9A9F9 FOREIGN KEY (idclient) REFERENCES client (idCl)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY facture_ibfk_1');
        $this->addSql('ALTER TABLE facture CHANGE facture facture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A3F9A9F9 FOREIGN KEY (idclient) REFERENCES client (idCl)');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY logo_ibfk_1');
        $this->addSql('ALTER TABLE logo CHANGE idClient idClient INT DEFAULT NULL');
        $this->addSql('ALTER TABLE logo ADD CONSTRAINT FK_E48E9A13A455ACCF FOREIGN KEY (idClient) REFERENCES client (idCl)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A3F9A9F9 FOREIGN KEY (idclient) REFERENCES client (idCl)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart DROP FOREIGN KEY FK_E5562A2AA3F9A9F9');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT chart_ibfk_1 FOREIGN KEY (idclient) REFERENCES client (idCl) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993A3F9A9F9');
        $this->addSql('ALTER TABLE contrat CHANGE docCtr docCtr VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE docBonLiv docBonLiv VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT contrat_ibfk_1 FOREIGN KEY (idclient) REFERENCES client (idCl) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A3F9A9F9');
        $this->addSql('ALTER TABLE facture CHANGE facture facture VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT facture_ibfk_1 FOREIGN KEY (idclient) REFERENCES client (idCl) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A13A455ACCF');
        $this->addSql('ALTER TABLE logo CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE logo ADD CONSTRAINT logo_ibfk_1 FOREIGN KEY (idClient) REFERENCES client (idCl) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A3F9A9F9');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (idclient) REFERENCES client (idCl) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
