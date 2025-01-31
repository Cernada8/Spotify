<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131164130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perfil DROP FOREIGN KEY FK_966576471C9C8804');
        $this->addSql('DROP INDEX IDX_966576471C9C8804 ON perfil');
        $this->addSql('ALTER TABLE perfil DROP estilo_musical_preferido_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perfil ADD estilo_musical_preferido_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE perfil ADD CONSTRAINT FK_966576471C9C8804 FOREIGN KEY (estilo_musical_preferido_id) REFERENCES estilo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_966576471C9C8804 ON perfil (estilo_musical_preferido_id)');
    }
}
