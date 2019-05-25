<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Blog extends Migrator
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
        $this->table('blog')
            ->addColumn(Column::string('name')->setComment('名字'))
            ->addColumn(Column::string('title')->setComment('标题'))
            ->addColumn(Column::integer('cate_id')->setComment('cate_id'))
            ->addColumn(Column::integer('user_id')->setComment('用户 id'))
            ->create();
    }
}
