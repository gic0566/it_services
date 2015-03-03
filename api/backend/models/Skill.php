<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord {

    public static function tableName() {
        return '{{%skill}}';
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
