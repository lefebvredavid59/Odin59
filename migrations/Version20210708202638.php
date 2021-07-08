<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708202638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, statue TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_value (link_id INT NOT NULL, value_id INT NOT NULL, INDEX IDX_B2CC04EAADA40271 (link_id), INDEX IDX_B2CC04EAF920BBA2 (value_id), PRIMARY KEY(link_id, value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE link_value ADD CONSTRAINT FK_B2CC04EAADA40271 FOREIGN KEY (link_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link_value ADD CONSTRAINT FK_B2CC04EAF920BBA2 FOREIGN KEY (value_id) REFERENCES value (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link_value DROP FOREIGN KEY FK_B2CC04EAADA40271');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE link_value');
    }
}
