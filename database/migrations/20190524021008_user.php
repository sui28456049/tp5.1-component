<?php

use think\migration\Migrator;
use think\migration\db\Column;

class User extends Migrator
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
        $this->table('user')
            ->addColumn(Column::string('name')->setComment('用户昵称'))
            ->addColumn(Column::string('username')->setComment('用户名'))
            ->addColumn(Column::string('email')->setComment('邮箱'))
            ->addColumn(Column::string('password')->setComment('密码'))
            ->addColumn(Column::string('birthday')->setComment('生日'))
            ->addColumn(Column::string('create_at')->setComment('创建时间'))
            ->addColumn(Column::string('update_at')->setComment('更新时间'))
            ->create();
    }
}
