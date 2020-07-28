<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180913170256 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_data (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(100) NOT NULL, email VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_D772BFAAF85E0677 (username), UNIQUE INDEX UNIQ_D772BFAAE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, imagenes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', titulo VARCHAR(50) NOT NULL, autor VARCHAR(50) NOT NULL, editorial VARCHAR(50) NOT NULL, descripcion VARCHAR(400) NOT NULL, disponibles INT NOT NULL, year INT NOT NULL, colportor NUMERIC(60, 2) NOT NULL, publico NUMERIC(60, 2) NOT NULL, clave INT NOT NULL, peso VARCHAR(20) NOT NULL, medidas VARCHAR(20) NOT NULL, categorias LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_4A1B2A9264E8588B (clave), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_data');
        $this->addSql('DROP TABLE books');
    }
}
