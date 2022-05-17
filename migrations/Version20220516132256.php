<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516132256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9D86650F');
        $this->addSql('DROP INDEX IDX_E00CEDDE9D86650F ON booking');
        $this->addSql('ALTER TABLE booking CHANGE user_id_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE217BBB47 FOREIGN KEY (person_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE217BBB47 ON booking (person_id)');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D9D86650F');
        $this->addSql('DROP INDEX IDX_67D5399D9D86650F ON house');
        $this->addSql('ALTER TABLE house CHANGE user_id_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D217BBB47 FOREIGN KEY (person_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_67D5399D217BBB47 ON house (person_id)');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BA4A739AF');
        $this->addSql('DROP INDEX IDX_729F519BA4A739AF ON room');
        $this->addSql('ALTER TABLE room CHANGE house_id_id house_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('CREATE INDEX IDX_729F519B6BB74515 ON room (house_id)');
        $this->addSql('ALTER TABLE room_line DROP FOREIGN KEY FK_B2105E9235F83FFC');
        $this->addSql('DROP INDEX IDX_B2105E9235F83FFC ON room_line');
        $this->addSql('ALTER TABLE room_line CHANGE room_id_id room_id INT NOT NULL');
        $this->addSql('ALTER TABLE room_line ADD CONSTRAINT FK_B2105E9254177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_B2105E9254177093 ON room_line (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE217BBB47');
        $this->addSql('DROP INDEX IDX_E00CEDDE217BBB47 ON booking');
        $this->addSql('ALTER TABLE booking CHANGE person_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9D86650F ON booking (user_id_id)');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399D217BBB47');
        $this->addSql('DROP INDEX IDX_67D5399D217BBB47 ON house');
        $this->addSql('ALTER TABLE house CHANGE person_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67D5399D9D86650F ON house (user_id_id)');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B6BB74515');
        $this->addSql('DROP INDEX IDX_729F519B6BB74515 ON room');
        $this->addSql('ALTER TABLE room CHANGE house_id house_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BA4A739AF FOREIGN KEY (house_id_id) REFERENCES house (id)');
        $this->addSql('CREATE INDEX IDX_729F519BA4A739AF ON room (house_id_id)');
        $this->addSql('ALTER TABLE room_line DROP FOREIGN KEY FK_B2105E9254177093');
        $this->addSql('DROP INDEX IDX_B2105E9254177093 ON room_line');
        $this->addSql('ALTER TABLE room_line CHANGE room_id room_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE room_line ADD CONSTRAINT FK_B2105E9235F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_B2105E9235F83FFC ON room_line (room_id_id)');
    }
}
