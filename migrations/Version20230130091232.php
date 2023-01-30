<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130091232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier ADD ssd_id INT DEFAULT NULL, ADD hdd_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2AF4238A5 FOREIGN KEY (ssd_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF21493816F FOREIGN KEY (hdd_id) REFERENCES composant (id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF2AF4238A5 ON panier (ssd_id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF21493816F ON panier (hdd_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2AF4238A5');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF21493816F');
        $this->addSql('DROP INDEX IDX_24CC0DF2AF4238A5 ON panier');
        $this->addSql('DROP INDEX IDX_24CC0DF21493816F ON panier');
        $this->addSql('ALTER TABLE panier DROP ssd_id, DROP hdd_id');
    }
}
