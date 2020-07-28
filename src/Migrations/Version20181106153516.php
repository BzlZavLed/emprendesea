<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106153516 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, last VARCHAR(20) NOT NULL, phone VARCHAR(15) NOT NULL, street VARCHAR(200) NOT NULL, entre VARCHAR(200) DEFAULT NULL, city VARCHAR(50) NOT NULL, cp VARCHAR(5) NOT NULL, state VARCHAR(50) NOT NULL, ship_id INT DEFAULT NULL, tracking VARCHAR(30) DEFAULT NULL, carrier VARCHAR(20) DEFAULT NULL, payment_id INT DEFAULT NULL, request_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido_content (id INT AUTO_INCREMENT NOT NULL, pedido_id INT NOT NULL, book_id INT NOT NULL, qtt INT NOT NULL, unit_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_rate (id INT AUTO_INCREMENT NOT NULL, pedido_id INT NOT NULL, carrier VARCHAR(10) NOT NULL, rate_id INT NOT NULL, cost DOUBLE PRECISION NOT NULL, logo VARCHAR(100) NOT NULL, service VARCHAR(100) NOT NULL, delivery DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pedido');
        $this->addSql('DROP TABLE pedido_content');
        $this->addSql('DROP TABLE delivery_rate');
    }
}
