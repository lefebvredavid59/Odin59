<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210709164101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link ADD mining TINYINT(1) NOT NULL, ADD ptc TINYINT(1) NOT NULL, ADD shortlink TINYINT(1) NOT NULL, ADD game TINYINT(1) NOT NULL, ADD auto TINYINT(1) NOT NULL, ADD captcha TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link DROP mining, DROP ptc, DROP shortlink, DROP game, DROP auto, DROP captcha');
    }
}
