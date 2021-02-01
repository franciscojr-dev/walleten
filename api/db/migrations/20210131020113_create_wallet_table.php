<?php

use Phinx\Migration\AbstractMigration;

class CreateWalletTable extends AbstractMigration
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
        $wallet = $this->table('wallet');
        $wallet->addColumn('description', 'string', ['limit' => 100])
              ->addColumn('primary', 'enum', ['values' => ['y', 'n']])
              ->addColumn('user_id', 'integer')
              ->addColumn('total_avg', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('total_balance', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('total_stock', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('total_fund', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('profit', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('variation', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('variation_money', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addForeignKey('user_id', 'user', ['id'], ['constraint' => 'fk_wallet_user_id'])
              ->create();
    }
}
