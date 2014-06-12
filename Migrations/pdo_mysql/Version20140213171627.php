<?php

namespace Icap\LessonBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/02/13 05:16:28
 */
class Version20140213171627 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE orange_done (
                lesson_id INT NOT NULL, 
                user_id INT NOT NULL, 
                done TINYINT(1) NOT NULL, 
                INDEX IDX_496C2AF6CDF80196 (lesson_id), 
                INDEX IDX_496C2AF6A76ED395 (user_id), 
                PRIMARY KEY(lesson_id, user_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF6CDF80196 FOREIGN KEY (lesson_id) 
            REFERENCES icap__lesson_chapter (id)
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF6A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE orange_done
        ");
    }
}