<?php

namespace Icap\LessonBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/03/24 06:22:49
 */
class Version20140324182248 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE orange_done 
            DROP CONSTRAINT FK_496C2AF6A76ED395
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            DROP CONSTRAINT FK_496C2AF6CDF80196
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF64F098335 FOREIGN KEY (Lesson_id) 
            REFERENCES icap__lesson_chapter (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF668D3EA09 FOREIGN KEY (User_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE orange_done 
            DROP CONSTRAINT FK_496C2AF64F098335
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            DROP CONSTRAINT FK_496C2AF668D3EA09
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF6A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE orange_done 
            ADD CONSTRAINT FK_496C2AF6CDF80196 FOREIGN KEY (lesson_id) 
            REFERENCES icap__lesson_chapter (id)
        ");
    }
}