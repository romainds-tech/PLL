<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013125832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE language_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE language_execution_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE language_exemple_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE language_exemple_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE language_paradigme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE paradigme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE language (id INT NOT NULL, language_execution_id INT NOT NULL, name VARCHAR(255) NOT NULL, typed BOOLEAN NOT NULL, description TEXT NOT NULL, execution_speed INT NOT NULL, developpement_speed INT NOT NULL, documentation VARCHAR(255) DEFAULT NULL, repository VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4DB71B5721EC191 ON language (language_execution_id)');
        $this->addSql('CREATE TABLE language_execution (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE language_exemple (id INT NOT NULL, language_id INT NOT NULL, code VARCHAR(255) NOT NULL, execution INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3FA1EA0B82F1BAF4 ON language_exemple (language_id)');
        $this->addSql('CREATE TABLE language_exemple_type (id INT NOT NULL, language_exemple_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9F8DAA146F54A2F6 ON language_exemple_type (language_exemple_id)');
        $this->addSql('CREATE TABLE language_paradigme (id INT NOT NULL, language_id_id INT NOT NULL, paradigme_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE5B25D51C9A06 ON language_paradigme (language_id_id)');
        $this->addSql('CREATE INDEX IDX_FE5B25D58A217D91 ON language_paradigme (paradigme_id_id)');
        $this->addSql('CREATE TABLE paradigme (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5721EC191 FOREIGN KEY (language_execution_id) REFERENCES language_execution (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE language_exemple ADD CONSTRAINT FK_3FA1EA0B82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE language_exemple_type ADD CONSTRAINT FK_9F8DAA146F54A2F6 FOREIGN KEY (language_exemple_id) REFERENCES language_exemple (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE language_paradigme ADD CONSTRAINT FK_FE5B25D51C9A06 FOREIGN KEY (language_id_id) REFERENCES language (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE language_paradigme ADD CONSTRAINT FK_FE5B25D58A217D91 FOREIGN KEY (paradigme_id_id) REFERENCES paradigme (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE language_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE language_execution_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE language_exemple_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE language_exemple_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE language_paradigme_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE paradigme_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE language DROP CONSTRAINT FK_D4DB71B5721EC191');
        $this->addSql('ALTER TABLE language_exemple DROP CONSTRAINT FK_3FA1EA0B82F1BAF4');
        $this->addSql('ALTER TABLE language_exemple_type DROP CONSTRAINT FK_9F8DAA146F54A2F6');
        $this->addSql('ALTER TABLE language_paradigme DROP CONSTRAINT FK_FE5B25D51C9A06');
        $this->addSql('ALTER TABLE language_paradigme DROP CONSTRAINT FK_FE5B25D58A217D91');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_execution');
        $this->addSql('DROP TABLE language_exemple');
        $this->addSql('DROP TABLE language_exemple_type');
        $this->addSql('DROP TABLE language_paradigme');
        $this->addSql('DROP TABLE paradigme');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
