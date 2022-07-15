<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715180843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE daily_usage (uuid UUID NOT NULL, day_id UUID NOT NULL, product_id UUID NOT NULL, usage INT NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_50CA3FA49C24126 ON daily_usage (day_id)');
        $this->addSql('CREATE INDEX IDX_50CA3FA44584665A ON daily_usage (product_id)');
        $this->addSql('COMMENT ON COLUMN daily_usage.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN daily_usage.day_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN daily_usage.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE day (uuid UUID NOT NULL, transaction_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN day.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN day.transaction_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE daily_usage ADD CONSTRAINT FK_50CA3FA49C24126 FOREIGN KEY (day_id) REFERENCES day (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_usage ADD CONSTRAINT FK_50CA3FA44584665A FOREIGN KEY (product_id) REFERENCES product (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE daily_usage DROP CONSTRAINT FK_50CA3FA49C24126');
        $this->addSql('DROP TABLE daily_usage');
        $this->addSql('DROP TABLE day');
    }
}
