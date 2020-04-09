<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408145658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('scopes');

        $table->addColumn('id', 'integer', [
            'notnull' => true,
            'autoincrement' => true,
        ]);

        $table->addColumn('name', 'string', [
            'notnull' => true,
        ]);




//        19b2531f4f3b3938fe74ae29888c437fcd3142b67c8e98895f2e52b79ac9d04c%
        // effc31d7516ff64893aec1c1888923c2

        $table->setPrimaryKey(array('id'));

    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO scopes (id, name) VALUES(1,"client")');

    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('scopes');

    }
}
