<?php

use Migrations\AbstractMigration;

class CreateRBruteForceLogs extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('rbruteforcelogs');
        $table->addColumn('data', 'text', ['null' => true]);
        $table->create();
        $table->changeColumn('id', 'integer', ['signed' => false, 'identity' => true]);
        $table->update();
    }
}