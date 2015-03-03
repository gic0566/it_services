<?php

namespace backend\models;

use yii\db\ActiveRecord;

class CompanyUser extends ActiveRecord {

    public static function tableName() {
        return '{{%company_user}}';
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
