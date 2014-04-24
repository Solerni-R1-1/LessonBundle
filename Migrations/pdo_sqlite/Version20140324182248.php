<?php

namespace Icap\LessonBundle\Migrations\pdo_sqlite;

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
            DROP INDEX IDX_496C2AF6CDF80196
        ");
        $this->addSql("
            DROP INDEX IDX_496C2AF6A76ED395
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__orange_done AS 
            SELECT lesson_id, 
            user_id, 
            done 
            FROM orange_done
        ");
        $this->addSql("
            DROP TABLE orange_done
        ");
        $this->addSql("
            CREATE TABLE orange_done (
                lesson_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                done BOOLEAN NOT NULL, 
                PRIMARY KEY(lesson_id, user_id), 
                CONSTRAINT FK_496C2AF64F098335 FOREIGN KEY (Lesson_id) 
                REFERENCES icap__lesson_chapter (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_496C2AF668D3EA09 FOREIGN KEY (User_id) 
                REFERENCES claro_user (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO orange_done (lesson_id, user_id, done) 
            SELECT lesson_id, 
            user_id, 
            done 
            FROM __temp__orange_done
        ");
        $this->addSql("
            DROP TABLE __temp__orange_done
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
            DROP INDEX IDX_496C2AF64F098335
        ");
        $this->addSql("
            DROP INDEX IDX_496C2AF668D3EA09
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__orange_done AS 
            SELECT done, 
            Lesson_id, 
            User_id 
            FROM orange_done
        ");
        $this->addSql("
            DROP TABLE orange_done
        ");
        $this->addSql("
            CREATE TABLE orange_done (
                User_id INTEGER NOT NULL, 
                Lesson_id INTEGER NOT NULL, 
                done BOOLEAN NOT NULL, 
                PRIMARY KEY(Lesson_id, User_id), 
                CONSTRAINT FK_496C2AF6A76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_496C2AF6CDF80196 FOREIGN KEY (lesson_id) 
                REFERENCES icap__lesson_chapter (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO orange_done (done, Lesson_id, User_id) 
            SELECT done, 
            Lesson_id, 
            User_id 
            FROM __temp__orange_done
        ");
        $this->addSql("
            DROP TABLE __temp__orange_done
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF64F098335 ON orange_done (Lesson_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_496C2AF668D3EA09 ON orange_done (User_id)
        ");
    }
}