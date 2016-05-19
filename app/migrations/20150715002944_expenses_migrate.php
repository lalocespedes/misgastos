<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ExpensesMigrate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
            $expenses = $this->table('expenses');
            $expenses->addColumn('supplier_id', 'integer')
                     ->addColumn('category_id', 'integer')
                     ->addColumn('user_id', 'integer')
                     ->addColumn('expense_date_entered', 'timestamp')
                     ->addColumn('expense_description', 'text')
                     ->addColumn('expense_amount', 'decimal', array('precision' => 10, 'scale' => 2))
                     ->addColumn('expense_subtotal', 'decimal', array('precision' => 10, 'scale' => 2))
                     ->addColumn('expense_descuento', 'decimal', array('precision' => 10, 'scale' => 2, 'null' => true))
                     ->addColumn('expense_folio', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_serie', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_moneda', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_TipoCambio', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_condicionesDePago', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_noCertificado', 'string', array('limit' =>  100))
                     ->addColumn('expense_certificado', 'string', array('limit' =>  100))
                     ->addColumn('expense_formaDePago', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_metodoDePago', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_NumCtaPago', 'string', array('limit' =>  100, 'null' => true))
                     ->addColumn('expense_LugarExpedicion', 'string', array('limit' =>  100))
                     ->addColumn('expense_sello', 'string', array('limit' =>  100))
                     ->addColumn('expense_uuid', 'string', array('limit' => 36, 'null' => true))
                     ->addColumn('created_at', 'timestamp')
                     ->addColumn('updated_at', 'timestamp', array(
                     'null'    => true,
                     'default' => null
                     ))
                     ->addIndex('id')
                     ->addIndex('supplier_id')
                     ->addIndex('category_id')
                     ->addIndex('user_id')
                     ->addForeignKey('category_id', 'expense_category', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
                     ->create();

    }
}
