<?php

namespace Icap\LessonBundle\Migrations\oci8;

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
                lesson_id NUMBER(10) NOT NULL, 
                user_id NUMBER(10) NOT NULL, 
                done NUMBER(1) NOT NULL, 
                PRIMARY KEY(lesson_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF6CDF80196 ON orange_done (lesson_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF6A76ED395 ON orange_done (user_id)
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