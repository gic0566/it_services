<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord {

    public static function tableName() {
        return '{{%user}}';
    }

    public function fields() {
        $fields = parent::fields();
        // remove fields that contain sensitive information

        return $fields;
    }

    public function extraFields() {
        $extraFields = parent::extraFields();
        return $extraFields;
    }

}
