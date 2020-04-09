<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405143224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {

        $table = $schema->createTable('pixel_tracking_data');

        $table->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);

        $table->addColumn('portalId', 'integer', [
            'notnull' => true,
        ]);

        $table->addColumn('userId', 'integer', [
            'notnull' => true,
        ]);
         $table->addColumn('pixelType', 'string', [
             'notnull' => true,
         ]);
         $table->addColumn('occurredOn', 'integer', [
             'notnull' => true,
         ]);


        $table->setPrimaryKey(array('id'));


    }

    public function down(Schema $schema) : void
    {
       $schema->dropTable('pixel_tracking_data');

    }
}
