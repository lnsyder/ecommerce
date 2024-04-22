<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421172939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tbl_cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_cart_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_order_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_product_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lkp_category (id BIGSERIAL NOT NULL, parent_category_id BIGINT DEFAULT NULL, category_name VARCHAR(255) NOT NULL, order_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1DB43B0D796A8F92 ON lkp_category (parent_category_id)');
        $this->addSql('CREATE TABLE lkp_payment_method (id BIGSERIAL NOT NULL, payment_method_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_cart (id INT NOT NULL, user_id INT DEFAULT NULL, cart_discount INT DEFAULT NULL, is_active BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BE83DD5FA76ED395 ON tbl_cart (user_id)');
        $this->addSql('CREATE TABLE tbl_cart_product (id INT NOT NULL, user_id INT DEFAULT NULL, product_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, product_discount INT DEFAULT NULL, product_quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D6C3B63CA76ED395 ON tbl_cart_product (user_id)');
        $this->addSql('CREATE INDEX IDX_D6C3B63C4584665A ON tbl_cart_product (product_id)');
        $this->addSql('CREATE INDEX IDX_D6C3B63C1AD5CDBF ON tbl_cart_product (cart_id)');
        $this->addSql('CREATE TABLE tbl_order (id INT NOT NULL, user_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, payment_method_id BIGINT DEFAULT NULL, order_price INT NOT NULL, order_status BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B4DD987A76ED395 ON tbl_order (user_id)');
        $this->addSql('CREATE INDEX IDX_5B4DD9871AD5CDBF ON tbl_order (cart_id)');
        $this->addSql('CREATE INDEX IDX_5B4DD9875AA1164F ON tbl_order (payment_method_id)');
        $this->addSql('CREATE TABLE tbl_order_product (id INT NOT NULL, user_id INT DEFAULT NULL, order_id INT DEFAULT NULL, product_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3CA2C8EDA76ED395 ON tbl_order_product (user_id)');
        $this->addSql('CREATE INDEX IDX_3CA2C8ED8D9F6D38 ON tbl_order_product (order_id)');
        $this->addSql('CREATE INDEX IDX_3CA2C8ED4584665A ON tbl_order_product (product_id)');
        $this->addSql('CREATE TABLE tbl_product (id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_code VARCHAR(255) DEFAULT NULL, product_description TEXT DEFAULT NULL, product_image VARCHAR(255) DEFAULT NULL, product_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_product_category (id INT NOT NULL, product_id INT DEFAULT NULL, category_id BIGINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C722F1244584665A ON tbl_product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_C722F12412469DE2 ON tbl_product_category (category_id)');
        $this->addSql('CREATE TABLE tbl_user (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38B383A1E7927C74 ON tbl_user (email)');
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
        $this->addSql('ALTER TABLE lkp_category ADD CONSTRAINT FK_1DB43B0D796A8F92 FOREIGN KEY (parent_category_id) REFERENCES lkp_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_cart ADD CONSTRAINT FK_BE83DD5FA76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_cart_product ADD CONSTRAINT FK_D6C3B63CA76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_cart_product ADD CONSTRAINT FK_D6C3B63C4584665A FOREIGN KEY (product_id) REFERENCES tbl_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_cart_product ADD CONSTRAINT FK_D6C3B63C1AD5CDBF FOREIGN KEY (cart_id) REFERENCES tbl_cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order ADD CONSTRAINT FK_5B4DD987A76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order ADD CONSTRAINT FK_5B4DD9871AD5CDBF FOREIGN KEY (cart_id) REFERENCES tbl_cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order ADD CONSTRAINT FK_5B4DD9875AA1164F FOREIGN KEY (payment_method_id) REFERENCES lkp_payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_product ADD CONSTRAINT FK_3CA2C8EDA76ED395 FOREIGN KEY (user_id) REFERENCES tbl_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_product ADD CONSTRAINT FK_3CA2C8ED8D9F6D38 FOREIGN KEY (order_id) REFERENCES tbl_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_product ADD CONSTRAINT FK_3CA2C8ED4584665A FOREIGN KEY (product_id) REFERENCES tbl_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_product_category ADD CONSTRAINT FK_C722F1244584665A FOREIGN KEY (product_id) REFERENCES tbl_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_product_category ADD CONSTRAINT FK_C722F12412469DE2 FOREIGN KEY (category_id) REFERENCES lkp_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tbl_cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_cart_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_order_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_product_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_user_id_seq CASCADE');
        $this->addSql('ALTER TABLE lkp_category DROP CONSTRAINT FK_1DB43B0D796A8F92');
        $this->addSql('ALTER TABLE tbl_cart DROP CONSTRAINT FK_BE83DD5FA76ED395');
        $this->addSql('ALTER TABLE tbl_cart_product DROP CONSTRAINT FK_D6C3B63CA76ED395');
        $this->addSql('ALTER TABLE tbl_cart_product DROP CONSTRAINT FK_D6C3B63C4584665A');
        $this->addSql('ALTER TABLE tbl_cart_product DROP CONSTRAINT FK_D6C3B63C1AD5CDBF');
        $this->addSql('ALTER TABLE tbl_order DROP CONSTRAINT FK_5B4DD987A76ED395');
        $this->addSql('ALTER TABLE tbl_order DROP CONSTRAINT FK_5B4DD9871AD5CDBF');
        $this->addSql('ALTER TABLE tbl_order DROP CONSTRAINT FK_5B4DD9875AA1164F');
        $this->addSql('ALTER TABLE tbl_order_product DROP CONSTRAINT FK_3CA2C8EDA76ED395');
        $this->addSql('ALTER TABLE tbl_order_product DROP CONSTRAINT FK_3CA2C8ED8D9F6D38');
        $this->addSql('ALTER TABLE tbl_order_product DROP CONSTRAINT FK_3CA2C8ED4584665A');
        $this->addSql('ALTER TABLE tbl_product_category DROP CONSTRAINT FK_C722F1244584665A');
        $this->addSql('ALTER TABLE tbl_product_category DROP CONSTRAINT FK_C722F12412469DE2');
        $this->addSql('DROP TABLE lkp_category');
        $this->addSql('DROP TABLE lkp_payment_method');
        $this->addSql('DROP TABLE tbl_cart');
        $this->addSql('DROP TABLE tbl_cart_product');
        $this->addSql('DROP TABLE tbl_order');
        $this->addSql('DROP TABLE tbl_order_product');
        $this->addSql('DROP TABLE tbl_product');
        $this->addSql('DROP TABLE tbl_product_category');
        $this->addSql('DROP TABLE tbl_user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
