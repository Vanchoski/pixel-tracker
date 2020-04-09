<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408144439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('api_clients');

        $table->addColumn('id', 'string', [
            'notnull' => true,
        ]);

        $table->addColumn('secret', 'string', [
            'notnull' => true,
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
        $this->connection->executeQuery('INSERT INTO api_clients (id,secret,name) VALUES("effc31d7516ff64893aec1c1888923c", "19b2531f4f3b3938fe74ae29888c437fcd3142b67c8e98895f2e52b79ac9d04c", "Team one")');

    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('api_clients');

    }
}
