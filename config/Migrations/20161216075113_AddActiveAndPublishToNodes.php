<?php
use Migrations\AbstractMigration;

class AddActiveAndPublishToNodes extends AbstractMigration
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
        $table = $this->table('nodes');
        $table->addColumn('active', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('published', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
