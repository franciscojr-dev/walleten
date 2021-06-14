<?php

use Phinx\Migration\AbstractMigration;

class CreateWalletTickerTable extends AbstractMigration
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
        $walletTicker = $this->table('wallet_ticker');
        $walletTicker->addColumn('ticker_id', 'integer')
              ->addColumn('wallet_id', 'integer')
              ->addColumn('amount', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('avg', 'string', ['limit' => 50, 'default' => '0.00'])
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addForeignKey('ticker_id', 'ticker', ['id'], ['constraint' => 'fk_ticker_ticker_id'])
              ->addForeignKey('wallet_id', 'wallet', ['id'], ['constraint' => 'fk_wallet_ticker_wallet_id'])
              ->create();
    }
}
