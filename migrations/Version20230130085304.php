<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130085304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composant CHANGE format format VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD carte_graphique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF221E1B659 FOREIGN KEY (carte_graphique_id) REFERENCES composant (id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF221E1B659 ON panier (carte_graphique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF221E1B659');
        $this->addSql('DROP INDEX IDX_24CC0DF221E1B659 ON panier');
        $this->addSql('ALTER TABLE panier DROP carte_graphique_id');
        $this->addSql('ALTER TABLE composant CHANGE format format VARCHAR(50) DEFAULT NULL');
    }
}
