<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516122431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bed_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, place INT NOT NULL, size VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, house_id INT DEFAULT NULL, status VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', begin_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, total_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_E00CEDDE9D86650F (user_id_id), INDEX IDX_E00CEDDE6BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, house_type_id INT DEFAULT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(150) NOT NULL, zipcode VARCHAR(8) NOT NULL, price_per_night DOUBLE PRECISION DEFAULT NULL, available INT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, lattitude VARCHAR(255) DEFAULT NULL, INDEX IDX_67D5399D9D86650F (user_id_id), INDEX IDX_67D5399D519B0A8E (house_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, house_id_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_729F519BA4A739AF (house_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_line (id INT AUTO_INCREMENT NOT NULL, room_id_id INT NOT NULL, bed_type_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_B2105E9235F83FFC (room_id_id), INDEX IDX_B2105E928158330E (bed_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(60) NOT NULL, last_name VARCHAR(70) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rating DOUBLE PRECISION DEFAULT NULL, birthdate DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D519B0A8E FOREIGN KEY (house_type_id) REFERENCES house_type (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BA4A739AF FOREIGN KEY (house_id_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE room_line ADD CONSTRAINT FK_B2105E9235F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room_line ADD CONSTRAINT FK_B2105E928158330E FOREIGN KEY (bed_type_id) REFERENCES bed_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_line DROP FOREIGN KEY FK_B2105E928158330E');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6BB74515');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BA4A739AF');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D519B0A8E');
        $this->addSql('ALTER TABLE room_line DROP FOREIGN KEY FK_B2105E9235F83FFC');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9D86650F');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D9D86650F');
        $this->addSql('DROP TABLE bed_type');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE house_type');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_line');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
