<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord {

    public static function tableName() {
        return '{{%skill}}';
    }

    public function rules() {
        return [
            [['name','parent_id'], 'required'], //此处required曾经写错require导致错误
        ];
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
