<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729163325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
         $this->addSql('ALTER TABLE `pedido` ADD `metodoPago` VARCHAR(15) NOT NULL AFTER `std_date`');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `pedido` DROP `metodoPago`');

    }
}
