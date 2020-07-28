<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418144822 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book_cath (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, imagenes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', titulo VARCHAR(50) NOT NULL, autor VARCHAR(50) NOT NULL, editorial VARCHAR(50) NOT NULL, descripcion VARCHAR(400) NOT NULL, disponibles INT NOT NULL, year INT NOT NULL, colportor NUMERIC(60, 2) NOT NULL, publico NUMERIC(60, 2) NOT NULL, peso DOUBLE PRECISION NOT NULL, categorias LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', portada VARCHAR(150) NOT NULL, height DOUBLE PRECISION NOT NULL, width DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, union_id INT NOT NULL, cuenta VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conference (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_rate (id INT AUTO_INCREMENT NOT NULL, pedido_id INT NOT NULL, carrier VARCHAR(10) NOT NULL, rate_id INT NOT NULL, cost DOUBLE PRECISION NOT NULL, logo VARCHAR(100) NOT NULL, service VARCHAR(100) NOT NULL, delivery DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE escuela (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, long_name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE extra_config (id INT AUTO_INCREMENT NOT NULL, valor VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indx_student (id INT AUTO_INCREMENT NOT NULL, foto VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, last VARCHAR(20) NOT NULL, phone VARCHAR(15) NOT NULL, street VARCHAR(200) NOT NULL, entre VARCHAR(200) DEFAULT NULL, city VARCHAR(50) NOT NULL, cp VARCHAR(5) NOT NULL, state VARCHAR(50) NOT NULL, ship_id INT DEFAULT NULL, tracking VARCHAR(30) DEFAULT NULL, carrier VARCHAR(20) DEFAULT NULL, payment_id VARCHAR(30) DEFAULT NULL, request_date DATETIME NOT NULL, email VARCHAR(100) NOT NULL, student_id INT NOT NULL, campo_id INT NOT NULL, delivery_service VARCHAR(100) DEFAULT NULL, delivery_price DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, total_lista DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido_content (id INT AUTO_INCREMENT NOT NULL, pedido_id INT NOT NULL, book_id INT NOT NULL, qtt INT NOT NULL, unit_price DOUBLE PRECISION NOT NULL, unit_price_list DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, foto VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, apellidos VARCHAR(100) NOT NULL, matricula VARCHAR(100) NOT NULL, telefono VARCHAR(100) NOT NULL, correo VARCHAR(100) NOT NULL, link VARCHAR(200) NOT NULL, facultad INT NOT NULL, verano INT NOT NULL, invierno INT NOT NULL, inter INT NOT NULL, status INT NOT NULL, tipo INT NOT NULL, foto VARCHAR(200) NOT NULL, descripcion VARCHAR(200) NOT NULL, inv_u INT NOT NULL, int_u INT NOT NULL, ver_u INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporadas (id INT AUTO_INCREMENT NOT NULL, fecha_inicial DATE NOT NULL, fecha_final DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `union` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_data (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(100) NOT NULL, email VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_D772BFAAF85E0677 (username), UNIQUE INDEX UNIQ_D772BFAAE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE book_cath');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE campos');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE delivery_rate');
        $this->addSql('DROP TABLE escuela');
        $this->addSql('DROP TABLE extra_config');
        $this->addSql('DROP TABLE indx_student');
        $this->addSql('DROP TABLE legal');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('DROP TABLE pedido_content');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE temporadas');
        $this->addSql('DROP TABLE `union`');
        $this->addSql('DROP TABLE user_data');
    }
}
