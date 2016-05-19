<?php

use Phinx\Migration\AbstractMigration;

class CategoriesMigration extends AbstractMigration
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
        $categories = $this->table('expense_category');
        $categories->addColumn('name', 'string', array('limit' =>  100))
                   ->addColumn('descripcion', 'string', array('limit' =>  100))
                   ->addColumn('created_at', 'timestamp')
                   ->addColumn('updated_at', 'timestamp', array(
                   'null'    => true,
                   'default' => null
                   ))
                   ->addIndex('id')
                   ->create();

        //insert categories
        $this->execute("
                      INSERT INTO `expense_category` (`id`, `name`) VALUES
                      (1,'Sin categoria'),
                      (2,'Servicios'),
                      (3,'Transporte'),
                      (4,'Impuestos'),
                      (5,'Arrendamiento'),
                      (6,'Seguros')
                      ");
    }
}
