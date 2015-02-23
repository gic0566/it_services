<?php

namespace app\models;

use yii\db\ActiveRecord;

class ExpertUser extends ActiveRecord {

    public static function tableName() {
        return '{{%expert_user}}';
    }

    public function fields() {
        $fields = parent::fields();
        // remove fields that contain sensitive information

        $fields['add_time'] = function() {
            return date('Y-m-d', $this->add_time);
        };

        $fields['login_time'] = function() {
            return date('Y-m-d', $this->login_time);
        };

        $fields['logout_time'] = function() {
            return date('Y-m-d', $this->logout_time);
        };

        return $fields;
    }

    public function extraFields() {
        $extraFields = parent::extraFields();
        return $extraFields;
    }

}
