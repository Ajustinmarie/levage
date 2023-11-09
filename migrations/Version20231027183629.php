<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027183629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moyen_de_levage (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, cmu INT NOT NULL, zoneservice VARCHAR(255) NOT NULL, fournisseur VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, statusmoyen VARCHAR(255) NOT NULL, dateverifbv DATE DEFAULT NULL, statut_bv VARCHAR(255) DEFAULT NULL, motifbv VARCHAR(255) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, pilotecloture VARCHAR(255) DEFAULT NULL, delais DATE DEFAULT NULL, actionscloture LONGTEXT DEFAULT NULL, commentaires LONGTEXT DEFAULT NULL, certificatce VARCHAR(255) DEFAULT NULL, ficheadequation VARCHAR(255) DEFAULT NULL, rapport VARCHAR(255) DEFAULT NULL, plan VARCHAR(255) DEFAULT NULL, notedecalcul VARCHAR(255) DEFAULT NULL, imagemoyen VARCHAR(255) DEFAULT NULL, approbationqualite TINYINT(1) DEFAULT NULL, approbationmaintenance TINYINT(1) DEFAULT NULL, dateenregistrement DATE NOT NULL, date_mise_ajour DATE DEFAULT NULL, statut_final VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moyen_de_levage');
    }
}
