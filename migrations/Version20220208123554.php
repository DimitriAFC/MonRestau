<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208123554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_BA388B74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, relation_user_id INT DEFAULT NULL, relation_zipcode_id INT DEFAULT NULL, relation_restaurant_id INT DEFAULT NULL, relation_cart_id INT DEFAULT NULL, date DATE NOT NULL, time TIME NOT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, total_price DOUBLE PRECISION NOT NULL, shipping_cost DOUBLE PRECISION NOT NULL, INDEX IDX_3781EC10F8646701 (livreur_id), INDEX IDX_3781EC10BE15C1E4 (relation_user_id), INDEX IDX_3781EC10ED72038 (relation_zipcode_id), INDEX IDX_3781EC10C470D58A (relation_restaurant_id), INDEX IDX_3781EC103AEDFCE (relation_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_status (delivery_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_65119C9212136921 (delivery_id), INDEX IDX_65119C926BF700BD (status_id), PRIMARY KEY(delivery_id, status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_user (id INT AUTO_INCREMENT NOT NULL, relation_user_id INT DEFAULT NULL, relation_secteur_id INT DEFAULT NULL, relation_zipcode_id INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D4F804C7BE15C1E4 (relation_user_id), INDEX IDX_D4F804C7756E9E1C (relation_secteur_id), INDEX IDX_D4F804C7ED72038 (relation_zipcode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT AUTO_INCREMENT NOT NULL, relation_info_user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EB7A4E6DD8AD82C9 (relation_info_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, relation_restaurant_id INT DEFAULT NULL, relation_category_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, picture VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_D34A04ADC470D58A (relation_restaurant_id), INDEX IDX_D34A04AD76C725F8 (relation_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, relation_secteur_id INT DEFAULT NULL, relation_user_id INT DEFAULT NULL, relation_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_EB95123F756E9E1C (relation_secteur_id), INDEX IDX_EB95123FBE15C1E4 (relation_user_id), INDEX IDX_EB95123FDC379EE2 (relation_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_zip_code (restaurant_id INT NOT NULL, zip_code_id INT NOT NULL, INDEX IDX_81092FB7B1E7706E (restaurant_id), INDEX IDX_81092FB79CEB97F7 (zip_code_id), PRIMARY KEY(restaurant_id, zip_code_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, number_plate VARCHAR(9) NOT NULL, INDEX IDX_1B80E486F8646701 (livreur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zip_code (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10F8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10BE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10ED72038 FOREIGN KEY (relation_zipcode_id) REFERENCES zip_code (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10C470D58A FOREIGN KEY (relation_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC103AEDFCE FOREIGN KEY (relation_cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE delivery_status ADD CONSTRAINT FK_65119C9212136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_status ADD CONSTRAINT FK_65119C926BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7BE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7756E9E1C FOREIGN KEY (relation_secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7ED72038 FOREIGN KEY (relation_zipcode_id) REFERENCES zip_code (id)');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DD8AD82C9 FOREIGN KEY (relation_info_user_id) REFERENCES info_user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC470D58A FOREIGN KEY (relation_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD76C725F8 FOREIGN KEY (relation_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F756E9E1C FOREIGN KEY (relation_secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FBE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FDC379EE2 FOREIGN KEY (relation_type_id) REFERENCES restaurant_type (id)');
        $this->addSql('ALTER TABLE restaurant_zip_code ADD CONSTRAINT FK_81092FB7B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_zip_code ADD CONSTRAINT FK_81092FB79CEB97F7 FOREIGN KEY (zip_code_id) REFERENCES zip_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486F8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC103AEDFCE');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD76C725F8');
        $this->addSql('ALTER TABLE delivery_status DROP FOREIGN KEY FK_65119C9212136921');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DD8AD82C9');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10F8646701');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486F8646701');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10C470D58A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC470D58A');
        $this->addSql('ALTER TABLE restaurant_zip_code DROP FOREIGN KEY FK_81092FB7B1E7706E');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FDC379EE2');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7756E9E1C');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F756E9E1C');
        $this->addSql('ALTER TABLE delivery_status DROP FOREIGN KEY FK_65119C926BF700BD');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10BE15C1E4');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7BE15C1E4');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FBE15C1E4');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10ED72038');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7ED72038');
        $this->addSql('ALTER TABLE restaurant_zip_code DROP FOREIGN KEY FK_81092FB79CEB97F7');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE delivery_status');
        $this->addSql('DROP TABLE info_user');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_zip_code');
        $this->addSql('DROP TABLE restaurant_type');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE zip_code');
    }
}
