<?php

use Phinx\Migration\AbstractMigration;

class CreateIndexTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $index = $this->table('index');
        $index->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('open', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('close', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('high', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('low', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('change', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('change_abs', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addIndex(['name'], ['unique' => true])
              ->create();
    }
}
