<?php

use Phinx\Migration\AbstractMigration;

class CompanyMigrate extends AbstractMigration
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
        $suppliers = $this->table('company');
        $suppliers->addColumn('key', 'string', array('limit' =>  50))
                  ->addColumn('value', 'string', array('limit' =>  255, 'null' => true))
                  ->addColumn('created_at', 'timestamp')
                  ->addColumn('updated_at', 'timestamp', array(
                  'null'    => true,
                  'default' => null
                  ))
                  ->addIndex('id')
                  ->create();

            //insert company fields
            $this->execute("
            INSERT INTO `company` (`id`, `key`, `value`) VALUES
            (1,'name',''),
            (2,'address',''),
            (3,'colonia',''),
            (4,'noExterior',''),
            (5,'noInterior',''),
            (6,'city',''),
            (7,'state',''),
            (8,'zip',''),
            (9,'country',''),
            (10,'phone_number',''),
            (11,'fax_number',''),
            (12,'mobile_number',''),
            (13,'email_address',''),
            (14,'web_address',''),
            (15,'company_name',''),
            (16,'tax_id',''),
            (17,'curp',''),
            (18,'cedprof',''),
            (19,'regimen_fiscal',''),
            (20,'CIForestal','')
            ");
    }
}
