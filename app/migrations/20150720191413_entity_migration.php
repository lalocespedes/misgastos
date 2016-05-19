<?php

use Phinx\Migration\AbstractMigration;

class EntityMigration extends AbstractMigration
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
        $entity = $this->table('entities');
        $entity->addColumn('user_id', 'integer')
               ->addColumn('entity_name', 'string', array('limit' => 255))
               ->addColumn('entity_address', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('entity_colonia', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('entity_noExterior', 'string', array('limit' => 50, 'null' => true))
               ->addColumn('entity_noInterior', 'string', array('limit' => 50, 'null' => true))
               ->addColumn('entity_city', 'string', array('limit' => 50, 'null' => true))
               ->addColumn('entity_state', 'string', array('limit' => 50, 'null' => true))
               ->addColumn('entity_zip', 'string', array('limit' => 10, 'null' => true))
               ->addColumn('entity_country', 'string', array('limit' => 25, 'null' => true))
               ->addColumn('entity_phone_number', 'string', array('limit' => 25, 'null' => true))
               ->addColumn('entity_fax_number', 'string', array('limit' => 25, 'null' => true))
               ->addColumn('entity_mobile_number', 'string', array('limit' => 25, 'null' => true))
               ->addColumn('entity_email_address', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('entity_web_address', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('entity_company_name', 'string', array('limit' => 255, 'null' => true))
               ->addColumn('entity_tax_id', 'string', array('limit' => 13))
               ->addColumn('entity_curp', 'string', array('limit' => 50, 'null' => true))
               ->addColumn('entity_cedprof', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('entity_regimen_fiscal', 'string', array('limit' => 255, 'null' => true))
               ->addColumn('entity_CIForestal', 'string', array('limit' => 100, 'null' => true))
               ->addColumn('created_at', 'timestamp')
               ->addColumn('updated_at', 'timestamp', array(
                     'null'    => true,
                     'default' => null
               ))
               ->addIndex('id')
               ->addIndex('user_id')
               ->create();
    }
}
