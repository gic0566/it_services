<?php

namespace app\models;

use yii\db\ActiveRecord;

class Task extends ActiveRecord {

    public static function tableName() {
        return '{{%task}}';
    }

    public function fields() {
        $fields = parent::fields();
        // remove fields that contain sensitive information

        $fields['add_time'] = function() {
            return date('Y-m-d', $this->add_time);
        };

        $fields['c_comment_time'] = function() {
            return date('Y-m-d', $this->c_comment_time);
        };
        
        $fields['e_comment_time'] = function() {
            return date('Y-m-d', $this->e_comment_time);
        };

        $fields['begin_time'] = function() {
            return date('Y-m-d', $this->begin_time);
        };

        $fields['finish_time'] = function() {
            return date('Y-m-d', $this->finish_time);
        };

        $fields['valid_end_time'] = function() {
            return date('Y-m-d', $this->valid_end_time);
        };

        return $fields;
    }

    public function extraFields() {
        $extraFields = parent::extraFields();
        return $extraFields;
    }

}
