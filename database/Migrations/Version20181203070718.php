<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;

include_once 'AbstractMigration.php';

class Version20181203070718 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE armory (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, cost INT NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crs (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, access_level VARCHAR(255) NOT NULL, registration_number VARCHAR(255) NOT NULL, dream VARCHAR(255) NOT NULL, INDEX IDX_61D59799FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_group (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', barrack_location_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, INDEX IDX_18A55841E481E7C6 (barrack_location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, lat VARCHAR(255) NOT NULL, `long` VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', location_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', date DATE NOT NULL, name VARCHAR(3) NOT NULL, INDEX IDX_9067F23C64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_intervention_group (mission_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', intervention_group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_E616A393BE6CAE90 (mission_id), INDEX IDX_E616A393C3C7A2E4 (intervention_group_id), PRIMARY KEY(mission_id, intervention_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_equipment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', armory_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', mission_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_618D22AA5C82C795 (armory_id), INDEX IDX_618D22AABE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crs ADD CONSTRAINT FK_61D59799FE54D947 FOREIGN KEY (group_id) REFERENCES intervention_group (id)');
        $this->addSql('ALTER TABLE intervention_group ADD CONSTRAINT FK_18A55841E481E7C6 FOREIGN KEY (barrack_location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE mission_intervention_group ADD CONSTRAINT FK_E616A393BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_intervention_group ADD CONSTRAINT FK_E616A393C3C7A2E4 FOREIGN KEY (intervention_group_id) REFERENCES intervention_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_equipment ADD CONSTRAINT FK_618D22AA5C82C795 FOREIGN KEY (armory_id) REFERENCES armory (id)');
        $this->addSql('ALTER TABLE mission_equipment ADD CONSTRAINT FK_618D22AABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
    }
}