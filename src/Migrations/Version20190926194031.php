<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926194031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promotion CHANGE name name VARCHAR(20) DEFAULT NULL, CHANGE pourcentage pourcentage DOUBLE PRECISION DEFAULT NULL, CHANGE montant montant DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE fabricant CHANGE tel tel VARCHAR(15) DEFAULT NULL, CHANGE adress adress VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD categorie_id INT DEFAULT NULL, CHANGE taille_id taille_id INT DEFAULT NULL, CHANGE promotion_id promotion_id INT DEFAULT NULL, CHANGE nbre_vendu nbre_vendu INT DEFAULT NULL, CHANGE image2 image2 VARCHAR(40) DEFAULT NULL, CHANGE image3 image3 VARCHAR(40) DEFAULT NULL, CHANGE image4 image4 VARCHAR(40) DEFAULT NULL, CHANGE image5 image5 VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D ON article');
        $this->addSql('ALTER TABLE article DROP categorie_id, CHANGE taille_id taille_id INT DEFAULT NULL, CHANGE promotion_id promotion_id INT DEFAULT NULL, CHANGE nbre_vendu nbre_vendu INT DEFAULT NULL, CHANGE image2 image2 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image3 image3 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image4 image4 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image5 image5 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE fabricant CHANGE tel tel VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE adress adress VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE promotion CHANGE name name VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE pourcentage pourcentage DOUBLE PRECISION DEFAULT \'NULL\', CHANGE montant montant DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
