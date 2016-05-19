<?php

use Phinx\Migration\AbstractMigration;

class SuppliersMigrate extends AbstractMigration
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
            $suppliers = $this->table('suppliers');
            $suppliers->addColumn('supplier_name', 'string', array('limit' =>  255))
                      ->addColumn('supplier_active', 'integer')
                      ->addColumn('supplier_address', 'string', array('limit' =>  100, 'null' => true))
                      ->addColumn('supplier_colonia', 'string', array('limit' =>  100, 'null' => true))
                      ->addColumn('supplier_noExterior', 'string', array('limit' =>  10, 'null' => true))
                      ->addColumn('supplier_noInterior', 'string', array('limit' =>  10, 'null' => true))
                      ->addColumn('supplier_city', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_state', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_zip', 'string', array('limit' =>  10, 'null' => true))
                      ->addColumn('supplier_country', 'string', array('limit' =>  25, 'null' => true))
                      ->addColumn('supplier_phone_number', 'string', array('limit' =>  25, 'null' => true))
                      ->addColumn('supplier_fax_number', 'string', array('limit' =>  25, 'null' => true))
                      ->addColumn('supplier_mobile_number', 'string', array('limit' =>  25, 'null' => true))
                      ->addColumn('supplier_email_address', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_web_address', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_notes', 'text', array('null' => true))
                      ->addColumn('supplier_tax_id', 'string', array('limit' =>  13, 'null' => true))
                      ->addColumn('supplier_etiqueta', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_cuenta_bancaria', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_banco', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('supplier_dias_credito', 'string', array('limit' =>  50, 'null' => true))
                      ->addColumn('created_at', 'timestamp')
                      ->addColumn('updated_at', 'timestamp', array(
                      'null'    => true,
                      'default' => null
                      ))
                      ->addIndex('id')
                      ->create();

    }
}
