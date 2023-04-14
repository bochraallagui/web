<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414094610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       
        $this->addSql('ALTER TABLE user ADD num_tel INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointderelais DROP FOREIGN KEY FK_797F47E8CE696ACE');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064048D9D2B1');
        $this->addSql('ALTER TABLE reponse ADD fk_id_admin INT DEFAULT NULL, ADD fk_id_reclamation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC75D06C2B1 FOREIGN KEY (fk_id_admin) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A37C401A FOREIGN KEY (fk_id_reclamation) REFERENCES reclamation (id_rec)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC75D06C2B1 ON reponse (fk_id_admin)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7A37C401A ON reponse (fk_id_reclamation)');
        $this->addSql('ALTER TABLE user DROP num_tel');
    }
}
