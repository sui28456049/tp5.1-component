<?php

use think\migration\Migrator;
use think\migration\db\Column;

class City extends Migrator
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
        $this->table('city')
            ->setId(false) //关闭自动设置主键
            ->addColumn(Column::string('id')->setUnique()->setComment('城市 id'))
            ->addColumn(Column::string('name')->setComment('城市名字'))
            ->create();
    }
}
