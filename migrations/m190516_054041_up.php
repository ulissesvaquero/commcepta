<?php

use yii\db\Migration;

/**
 * Class m190516_054041_up
 */
class m190516_054041_up extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190516_054041_up cannot be reverted.\n";

        return false;
    }

    
    /**
     * Criar a base
     * {@inheritDoc}
     * @see \yii\db\Migration::up()
     */
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('produto', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%produto}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'nome' => 'VARCHAR(100) NOT NULL',
                    'descricao' => 'TEXT NULL',
                    'valor' => 'DOUBLE NOT NULL',
                    'is_ativo' => 'TINYINT(4) NULL DEFAULT \'1\'',
                ], $tableOptions_mysql);
            }
        }
        
        /* MYSQL */
        if (!in_array('venda', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%venda}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'vendedor_id' => 'INT(11) NOT NULL',
                    'valor_total' => 'DOUBLE NULL',
                    'dt_criacao' => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ',
                    'is_ativo' => 'TINYINT(4) NULL DEFAULT \'1\'',
                ], $tableOptions_mysql);
            }
        }
        
        /* MYSQL */
        if (!in_array('venda_produto', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%venda_produto}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'venda_id' => 'INT(11) NULL',
                    'produto_id' => 'INT(11) NULL',
                    'qtd' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }
        
        /* MYSQL */
        if (!in_array('vendedor', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%vendedor}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'nome' => 'VARCHAR(100) NOT NULL',
                    'telefone' => 'VARCHAR(20) NULL',
                    'endereco' => 'VARCHAR(255) NULL',
                    'is_ativo' => 'TINYINT(4) NULL DEFAULT \'1\'',
                ], $tableOptions_mysql);
            }
        }
        
        
        $this->createIndex('idx_vendedor_id_6934_00','venda','vendedor_id',0);
        $this->createIndex('idx_produto_id_7001_01','venda_produto','produto_id',0);
        $this->createIndex('idx_venda_id_7001_02','venda_produto','venda_id',0);
        
        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_vendedor_693_00','{{%venda}}', 'vendedor_id', '{{%vendedor}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('fk_produto_6998_01','{{%venda_produto}}', 'produto_id', '{{%produto}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('fk_venda_6998_02','{{%venda_produto}}', 'venda_id', '{{%venda}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->execute('SET foreign_key_checks = 1;');
    }
    
    /**
     * Desfazer a base
     * {@inheritDoc}
     * @see \yii\db\Migration::down()
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `produto`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `venda`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `venda_produto`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `vendedor`');
        $this->execute('SET foreign_key_checks = 1;');
    }
    
}
