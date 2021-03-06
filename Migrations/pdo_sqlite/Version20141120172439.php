<?php

namespace Icap\LessonBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/20 05:24:40
 */
class Version20141120172439 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE icap__lesson_chapter 
            ADD COLUMN published BOOLEAN NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_3D7E3C8C989D9B62
        ");
        $this->addSql("
            DROP INDEX IDX_3D7E3C8CCDF80196
        ");
        $this->addSql("
            DROP INDEX IDX_3D7E3C8C727ACA70
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__icap__lesson_chapter AS 
            SELECT id, 
            lesson_id, 
            parent_id, 
            title, 
            text, 
            slug, 
            lft, 
            lvl, 
            rgt, 
            root 
            FROM icap__lesson_chapter
        ");
        $this->addSql("
            DROP TABLE icap__lesson_chapter
        ");
        $this->addSql("
            CREATE TABLE icap__lesson_chapter (
                id INTEGER NOT NULL, 
                lesson_id INTEGER DEFAULT NULL, 
                parent_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                text CLOB DEFAULT NULL, 
                slug VARCHAR(128) NOT NULL, 
                lft INTEGER NOT NULL, 
                lvl INTEGER NOT NULL, 
                rgt INTEGER NOT NULL, 
                root INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_3D7E3C8CCDF80196 FOREIGN KEY (lesson_id) 
                REFERENCES icap__lesson (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_3D7E3C8C727ACA70 FOREIGN KEY (parent_id) 
                REFERENCES icap__lesson_chapter (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO icap__lesson_chapter (
                id, lesson_id, parent_id, title, text, 
                slug, lft, lvl, rgt, root
            ) 
            SELECT id, 
            lesson_id, 
            parent_id, 
            title, 
            text, 
            slug, 
            lft, 
            lvl, 
            rgt, 
            root 
            FROM __temp__icap__lesson_chapter
        ");
        $this->addSql("
            DROP TABLE __temp__icap__lesson_chapter
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_3D7E3C8C989D9B62 ON icap__lesson_chapter (slug)
        ");
        $this->addSql("
            CREATE INDEX IDX_3D7E3C8CCDF80196 ON icap__lesson_chapter (lesson_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_3D7E3C8C727ACA70 ON icap__lesson_chapter (parent_id)
        ");
    }
}