<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203154635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, pictures LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures_projet_projet (pictures_projet_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_4E71E72EED0B7E78 (pictures_projet_id), INDEX IDX_4E71E72EC18272 (projet_id), PRIMARY KEY(pictures_projet_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pictures_projet_projet ADD CONSTRAINT FK_4E71E72EED0B7E78 FOREIGN KEY (pictures_projet_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pictures_projet_projet ADD CONSTRAINT FK_4E71E72EC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pictures_projet_projet DROP FOREIGN KEY FK_4E71E72EED0B7E78');
        $this->addSql('ALTER TABLE pictures_projet_projet DROP FOREIGN KEY FK_4E71E72EC18272');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE pictures_projet_projet');
        $this->addSql('DROP TABLE projet');
    }
}
