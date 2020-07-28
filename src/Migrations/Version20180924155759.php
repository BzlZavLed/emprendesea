<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180924155759 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE escuela (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, long_name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_cath (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, union_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, apellidos VARCHAR(100) NOT NULL, matricula VARCHAR(100) NOT NULL, telefono VARCHAR(100) NOT NULL, correo VARCHAR(100) NOT NULL, link VARCHAR(200) NOT NULL, facultad INT NOT NULL, verano INT NOT NULL, invierno INT NOT NULL, inter INT NOT NULL, status INT NOT NULL, tipo INT NOT NULL, foto VARCHAR(200) NOT NULL, descripcion VARCHAR(200) NOT NULL, inv_u INT NOT NULL, int_u INT NOT NULL, ver_u INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `union` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE escuela');
        $this->addSql('DROP TABLE book_cath');
        $this->addSql('DROP TABLE campos');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE `union`');
    }
}
