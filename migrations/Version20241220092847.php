<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241220092847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E747EE6971 ON clients (ssn)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E74CAB86C7B ON clients (contact_email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E74696587D2 ON clients (contact_phone)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_C82E747EE6971');
        $this->addSql('DROP INDEX UNIQ_C82E74CAB86C7B');
        $this->addSql('DROP INDEX UNIQ_C82E74696587D2');
    }
}
