<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203155551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, pictures LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures_projet_projets (pictures_projet_id INT NOT NULL, projets_id INT NOT NULL, INDEX IDX_C796B323ED0B7E78 (pictures_projet_id), INDEX IDX_C796B323597A6CB7 (projets_id), PRIMARY KEY(pictures_projet_id, projets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pictures_projet_projets ADD CONSTRAINT FK_C796B323ED0B7E78 FOREIGN KEY (pictures_projet_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pictures_projet_projets ADD CONSTRAINT FK_C796B323597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pictures_projet_projets DROP FOREIGN KEY FK_C796B323ED0B7E78');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE pictures_projet_projets');
    }
}
