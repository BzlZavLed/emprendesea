<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723223949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE migration_versions');
        $this->addSql('ALTER TABLE books CHANGE imagenes imagenes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE categorias categorias INT NOT NULL');
        $this->addSql('ALTER TABLE pedido ADD std_name VARCHAR(100) DEFAULT NULL, ADD std_place VARCHAR(100) DEFAULT NULL, ADD std_date VARCHAR(100) DEFAULT NULL, CHANGE entre entre VARCHAR(200) DEFAULT NULL, CHANGE ship_id ship_id INT DEFAULT NULL, CHANGE tracking tracking VARCHAR(30) DEFAULT NULL, CHANGE carrier carrier VARCHAR(20) DEFAULT NULL, CHANGE payment_id payment_id VARCHAR(30) DEFAULT NULL, CHANGE delivery_service delivery_service VARCHAR(100) DEFAULT NULL, CHANGE delivery_price delivery_price DOUBLE PRECISION DEFAULT NULL, CHANGE total total DOUBLE PRECISION DEFAULT NULL, CHANGE total_lista total_lista DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE books CHANGE imagenes imagenes LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE categorias categorias LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE pedido DROP std_name, DROP std_place, DROP std_date, CHANGE entre entre VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ship_id ship_id INT DEFAULT NULL, CHANGE tracking tracking VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE carrier carrier VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE payment_id payment_id VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE delivery_service delivery_service VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE delivery_price delivery_price DOUBLE PRECISION DEFAULT \'NULL\', CHANGE total total DOUBLE PRECISION DEFAULT \'NULL\', CHANGE total_lista total_lista DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
