<?php

use Phinx\Migration\AbstractMigration;

class ExpensesTaxesMigration extends AbstractMigration
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
            $tax_rates = $this->table('tax_rates');
            $tax_rates->addColumn('tax_rate_name', 'string', array('limit' =>  25))
                      ->addColumn('tax_rate_percent', 'decimal', array('precision' => 6, 'scale' => 4))
                      ->addColumn('tax_type', 'string', array('limit' =>  25))
                      ->addColumn('tax_name', 'string', array('limit' =>  25))
                      ->addColumn('created_at', 'timestamp')
                      ->addColumn('updated_at', 'timestamp', array(
                      'null'    => true,
                      'default' => null
                      ))
                      ->addIndex('id')
                      ->create();


            //insert taxes
            $this->execute("
                            INSERT INTO `tax_rates` (`id`, `tax_rate_name`, `tax_rate_percent`, `tax_type`, `tax_name`) VALUES
                            (1,'IVA',16.0000,'T','IVA'),
                            (2,'IEPS',8.0000,'T','IEPS'),
                            (3,'IVA',1.0000,'T','IVA TASA CERO'),
                            (4,'IVA',-10.6666,'R','RETENCION IVA'),
                            (5,'ISR',-10.0000,'R','RETENCION ISR'),
                            (6,'ISH',3.0000,'TL','ISH')
                            ");

            $expenses_taxes = $this->table('expenses_taxes');
            $expenses_taxes->addColumn('expense_id', 'integer')
                           ->addColumn('tax_rate_id', 'integer')
                           ->addColumn('tax_amount', 'decimal', array('precision' => 10, 'scale' => 2))
                           ->addColumn('created_at', 'timestamp')
                           ->addColumn('updated_at', 'timestamp', array(
                           'null'    => true,
                           'default' => null
                           ))
                           ->addIndex('id')
                           ->addIndex('expense_id')
                           ->addIndex('tax_rate_id')
                           ->create();
    }
}
