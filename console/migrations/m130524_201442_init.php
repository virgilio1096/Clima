<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            
        ], $tableOptions);
        
        $this->createTable('{{%ubicaClima}}', [
            'id' => $this->primaryKey(),
            'estacion' => $this->string(50),
            'ubicacion' => $this->string(50),
            'latitudN' => $this->string(50),
            'longitudO' => $this->string(50),
            'altitud' => $this->double(),
            
        ], $tableOptions);        
        
        $this->createTable('{{%infoClima}}', [
            'id' => $this->primaryKey(),
            'ubi' => $this->integer(),
            'fecha' => $this->string(100),
            'direccionRafagas' => $this->double(),
            'DireccionViento' => $this->double(),
            'humedadRelativa' => $this->double(),
            'precipitacion' => $this->double(),
            'radicionSolar' => $this->double(),
            'rapidesRafaga' => $this->double(),
            'rapidesViento' => $this->double(),
            'temperaturaAire' => $this->double(),
            
        ], $tableOptions);        
            $this->addForeignKey('FK_prom_proy', 'infoClima', 'ubi', 'ubicaClima', 'id');
        
        
    }
    

    public function safeDown()
    {
        $this ->dropForeignKey('FK_prom_proy', 'infoclima');
        $this->dropTable('{{%user}}');
         $this->dropTable('{{%ubicaClima}}');
          $this->dropTable('{{%infoClima}}');
        
    }
}
