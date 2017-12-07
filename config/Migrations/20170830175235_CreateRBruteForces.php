<?php

use Migrations\AbstractMigration;

class CreateRBruteForces extends AbstractMigration
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
        $table = $this->table('rbruteforces', ['id' => false, 'primary_key' => ['expire']]);
        $table
            ->addColumn('ip', 'string', ['length' => 255])
            ->addColumn('url', 'string', ['length' => 255])
            ->addColumn('expire', 'timestamp', ['default' => null])
            ->addIndex('ip');
        $table->create();
    }
}