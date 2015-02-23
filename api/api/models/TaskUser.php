<?php

namespace app\models;

use yii\db\ActiveRecord;

class TaskUser extends ActiveRecord {

    public static function tableName() {
        return '{{%task_user}}';
    }

    public function fields() {
        $fields = parent::fields();
        // remove fields that contain sensitive information

        $fields['add_time'] = function() {
            return date('Y-m-d', $this->add_time);
        };

        return $fields;
    }

    public function extraFields() {
        $extraFields = parent::extraFields();
        return $extraFields;
    }

}
