<?php

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409204322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {


            $table = $schema->createTable('api_client_scopes');

            $table->addColumn('id', 'integer', [
                'notnull' => true,
                'autoincrement' => true,
            ]);

            $table->addColumn('client_id', 'string', [
                'notnull' => true,
            ]);
            $table->addColumn('scope_id', 'integer', [
                'notnull' => true,
            ]);
             $table->addForeignKeyConstraint('scopes',['scope_id'],['id']);


            $table->setPrimaryKey(array('id'));

    }


    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO api_client_scopes (client_id, scope_id) VALUES("effc31d7516ff64893aec1c1888923c", 1)');

    }
    public function down(Schema $schema) : void
    {
        $schema->dropTable('api_client_scopes');

    }
}
