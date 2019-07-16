<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716074421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, product_price VARCHAR(255) NOT NULL, product_quantity INT NOT NULL, user_id INT NOT NULL, product_url_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE bathtub');
        $this->addSql('DROP TABLE paint');
        $this->addSql('DROP TABLE shower');
        $this->addSql('DROP TABLE sink');
        $this->addSql('DROP TABLE toilets');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bathtub (id INT AUTO_INCREMENT NOT NULL, bathtub_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, bathtub_price VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, bathtub_url_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE paint (id INT AUTO_INCREMENT NOT NULL, paint_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, paint_price DOUBLE PRECISION NOT NULL, paint_url_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shower (id INT AUTO_INCREMENT NOT NULL, shower_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, shower_price DOUBLE PRECISION NOT NULL, shower_url_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sink (id INT AUTO_INCREMENT NOT NULL, sink_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, sink_price DOUBLE PRECISION NOT NULL, sink_url_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE toilets (id INT AUTO_INCREMENT NOT NULL, toilets_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, toilets_price DOUBLE PRECISION NOT NULL, toilets_url_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE basket');
    }
}
