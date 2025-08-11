<?php

use yii\db\Migration;

class M250811_052603_create_logs_table extends Migration{
    public function safeUp(){
        $this->createTable('{{%logs}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(45)->notNull(),
            'request_datetime' => $this->dateTime()->notNull(),
            'url' => $this->string(2048),
            'user_agent' => $this->text(),
            'os' => $this->string(100),
            'architecture' => $this->string(50),
            'browser' => $this->string(100),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    public function safeDown(){
        $this->dropTable('%logs');
    }
}