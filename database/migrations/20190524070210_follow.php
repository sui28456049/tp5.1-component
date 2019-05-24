<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Follow extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('follow')
            ->addColumn(Column::string('user_id')->setComment('用户 id'))
            ->addColumn(Column::string('follow_id')->setComment('被关注 id'))
            ->addColumn(Column::string('create_at')->setComment('创建时间'))
            ->addColumn(Column::string('update_at')->setComment('更新时间'))
            ->addColumn(Column::string('status')->setComment('状态'))
            ->create();
    }
}
