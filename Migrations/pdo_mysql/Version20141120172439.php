<?php

namespace Icap\LessonBundle\Migrations\pdo_mysql;

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
            ADD published TINYINT(1) NOT NULL
        ");

		$this->addSql("
			UPDATE icap__lesson_chapter
			SET published = 1
		");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE icap__lesson_chapter 
            DROP published
        ");
    }
}
