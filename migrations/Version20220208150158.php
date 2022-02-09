<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208150158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery_status (delivery_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_65119C9212136921 (delivery_id), INDEX IDX_65119C926BF700BD (status_id), PRIMARY KEY(delivery_id, status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT AUTO_INCREMENT NOT NULL, relation_info_user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EB7A4E6DD8AD82C9 (relation_info_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_zip_code (restaurant_id INT NOT NULL, zip_code_id INT NOT NULL, INDEX IDX_81092FB7B1E7706E (restaurant_id), INDEX IDX_81092FB79CEB97F7 (zip_code_id), PRIMARY KEY(restaurant_id, zip_code_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delivery_status ADD CONSTRAINT FK_65119C9212136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_status ADD CONSTRAINT FK_65119C926BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DD8AD82C9 FOREIGN KEY (relation_info_user_id) REFERENCES info_user (id)');
        $this->addSql('ALTER TABLE restaurant_zip_code ADD CONSTRAINT FK_81092FB7B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_zip_code ADD CONSTRAINT FK_81092FB79CEB97F7 FOREIGN KEY (zip_code_id) REFERENCES zip_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BA388B74584665A ON cart (product_id)');
        $this->addSql('ALTER TABLE delivery ADD livreur_id INT DEFAULT NULL, ADD relation_user_id INT DEFAULT NULL, ADD relation_zipcode_id INT DEFAULT NULL, ADD relation_restaurant_id INT DEFAULT NULL, ADD relation_cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10F8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10BE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10ED72038 FOREIGN KEY (relation_zipcode_id) REFERENCES zip_code (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10C470D58A FOREIGN KEY (relation_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC103AEDFCE FOREIGN KEY (relation_cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10F8646701 ON delivery (livreur_id)');
        $this->addSql('CREATE INDEX IDX_3781EC10BE15C1E4 ON delivery (relation_user_id)');
        $this->addSql('CREATE INDEX IDX_3781EC10ED72038 ON delivery (relation_zipcode_id)');
        $this->addSql('CREATE INDEX IDX_3781EC10C470D58A ON delivery (relation_restaurant_id)');
        $this->addSql('CREATE INDEX IDX_3781EC103AEDFCE ON delivery (relation_cart_id)');
        $this->addSql('ALTER TABLE info_user ADD relation_user_id INT DEFAULT NULL, ADD relation_secteur_id INT DEFAULT NULL, ADD relation_zipcode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7BE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7756E9E1C FOREIGN KEY (relation_secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7ED72038 FOREIGN KEY (relation_zipcode_id) REFERENCES zip_code (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4F804C7BE15C1E4 ON info_user (relation_user_id)');
        $this->addSql('CREATE INDEX IDX_D4F804C7756E9E1C ON info_user (relation_secteur_id)');
        $this->addSql('CREATE INDEX IDX_D4F804C7ED72038 ON info_user (relation_zipcode_id)');
        $this->addSql('ALTER TABLE product ADD relation_restaurant_id INT DEFAULT NULL, ADD relation_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC470D58A FOREIGN KEY (relation_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD76C725F8 FOREIGN KEY (relation_category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC470D58A ON product (relation_restaurant_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD76C725F8 ON product (relation_category_id)');
        $this->addSql('ALTER TABLE restaurant ADD relation_secteur_id INT DEFAULT NULL, ADD relation_user_id INT DEFAULT NULL, ADD relation_type_id INT DEFAULT NULL, ADD picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F756E9E1C FOREIGN KEY (relation_secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FBE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FDC379EE2 FOREIGN KEY (relation_type_id) REFERENCES restaurant_type (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F756E9E1C ON restaurant (relation_secteur_id)');
        $this->addSql('CREATE INDEX IDX_EB95123FBE15C1E4 ON restaurant (relation_user_id)');
        $this->addSql('CREATE INDEX IDX_EB95123FDC379EE2 ON restaurant (relation_type_id)');
        $this->addSql('ALTER TABLE vehicle ADD livreur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486F8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486F8646701 ON vehicle (livreur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10F8646701');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486F8646701');
        $this->addSql('DROP TABLE delivery_status');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE restaurant_zip_code');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('DROP INDEX IDX_BA388B74584665A ON cart');
        $this->addSql('ALTER TABLE cart DROP product_id');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10BE15C1E4');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10ED72038');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10C470D58A');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC103AEDFCE');
        $this->addSql('DROP INDEX IDX_3781EC10F8646701 ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC10BE15C1E4 ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC10ED72038 ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC10C470D58A ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC103AEDFCE ON delivery');
        $this->addSql('ALTER TABLE delivery DROP livreur_id, DROP relation_user_id, DROP relation_zipcode_id, DROP relation_restaurant_id, DROP relation_cart_id, CHANGE adress adress VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7BE15C1E4');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7756E9E1C');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7ED72038');
        $this->addSql('DROP INDEX UNIQ_D4F804C7BE15C1E4 ON info_user');
        $this->addSql('DROP INDEX IDX_D4F804C7756E9E1C ON info_user');
        $this->addSql('DROP INDEX IDX_D4F804C7ED72038 ON info_user');
        $this->addSql('ALTER TABLE info_user DROP relation_user_id, DROP relation_secteur_id, DROP relation_zipcode_id, CHANGE first_name first_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC470D58A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD76C725F8');
        $this->addSql('DROP INDEX IDX_D34A04ADC470D58A ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD76C725F8 ON product');
        $this->addSql('ALTER TABLE product DROP relation_restaurant_id, DROP relation_category_id, CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F756E9E1C');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FBE15C1E4');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FDC379EE2');
        $this->addSql('DROP INDEX IDX_EB95123F756E9E1C ON restaurant');
        $this->addSql('DROP INDEX IDX_EB95123FBE15C1E4 ON restaurant');
        $this->addSql('DROP INDEX IDX_EB95123FDC379EE2 ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP relation_secteur_id, DROP relation_user_id, DROP relation_type_id, DROP picture, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE restaurant_type CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE secteur CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE status CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_1B80E486F8646701 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP livreur_id, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE number_plate number_plate VARCHAR(9) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE zip_code CHANGE number number VARCHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
