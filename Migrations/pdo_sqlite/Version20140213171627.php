<?php

namespace Icap\LessonBundle\Migrations\pdo_sqlite;

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
                lesson_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                done BOOLEAN NOT NULL, 
                PRIMARY KEY(lesson_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF6CDF80196 ON orange_done (lesson_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF6A76ED395 ON orange_done (user_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE orange_done
        ");
    }
}