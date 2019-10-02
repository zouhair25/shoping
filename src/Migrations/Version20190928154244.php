<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928154244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couleur CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion CHANGE name name VARCHAR(20) DEFAULT NULL, CHANGE pourcentage pourcentage DOUBLE PRECISION DEFAULT NULL, CHANGE montant montant DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE fabricant CHANGE tel tel VARCHAR(15) DEFAULT NULL, CHANGE adress adress VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE fabricant_id fabricant_id INT DEFAULT NULL, CHANGE taille_id taille_id INT DEFAULT NULL, CHANGE promotion_id promotion_id INT DEFAULT NULL, CHANGE color_id color_id INT DEFAULT NULL, CHANGE nbre_vendu nbre_vendu INT DEFAULT NULL, CHANGE image1 image1 VARCHAR(60) NOT NULL, CHANGE image2 image2 VARCHAR(40) DEFAULT NULL, CHANGE image3 image3 VARCHAR(40) DEFAULT NULL, CHANGE image4 image4 VARCHAR(40) DEFAULT NULL, CHANGE image5 image5 VARCHAR(40) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE fabricant_id fabricant_id INT NOT NULL, CHANGE taille_id taille_id INT DEFAULT NULL, CHANGE promotion_id promotion_id INT DEFAULT NULL, CHANGE color_id color_id INT DEFAULT NULL, CHANGE nbre_vendu nbre_vendu INT DEFAULT NULL, CHANGE image1 image1 VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image2 image2 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image3 image3 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image4 image4 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image5 image5 VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE couleur CHANGE active active TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE fabricant CHANGE tel tel VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE adress adress VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE promotion CHANGE name name VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE pourcentage pourcentage DOUBLE PRECISION DEFAULT \'NULL\', CHANGE montant montant DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
