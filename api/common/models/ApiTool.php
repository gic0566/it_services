<?php

namespace common\models;

use Yii;
use yii\base\Model;

class ApiTool extends Model {

    function tree($table, $p_id = '0', $id_column = 'id') {
        $tree = array();
        foreach ($table as $row) {
            if ($row['parent_id'] == $p_id) {
                $tmp = self::tree($table, $row[$id_column], $id_column);
                if ($tmp) {
                    $row['children'] = $tmp;
                } else {
                    $row['leaf'] = true;
                }
                $tree[] = $row;
            }
        }
        Return $tree;
    }

    //格式化post数据
    function post_format($arr = '') {
        if (is_array($arr) && !empty($arr)) {
            foreach ($arr as $k => $v) {
                $arr[$k] = urldecode(trim($v));
            }
        }
        return $arr;
    }

    /**
     * 截取UTF-8编码下字符串的函数
     *
     * @param   string      $str        被截取的字符串
     * @param   int         $length     截取的长度
     * @param   bool        $append     是否附加省略号
     *
     * @return  string
     */
    function subStr($str, $length = 0, $append = true) {

        $str = trim($str);
        $strlength = strlen($str);

        if ($length == 0 || $length >= $strlength) {
            return $str;
        } elseif ($length < 0) {
            $length = $strlength + $length;
            if ($length < 0) {
                $length = $strlength;
            }
        }

        if (function_exists('mb_substr')) {
            $newstr = mb_substr($str, 0, $length, 'utf-8');
        } elseif (function_exists('iconv_substr')) {
            $newstr = iconv_substr($str, 0, $length, 'utf-8');
        } else {
            //$newstr = trim_right(substr($str, 0, $length));
            $newstr = substr($str, 0, $length);
        }

        if ($append && $str != $newstr) {
            $newstr .= '...';
        }

        return $newstr;
    }
    
    function fileExists($uploadpath) {

        if (!file_exists($uploadpath)) {
            mkdir($uploadpath, 0777, true);
        }

        return $uploadpath;
    }

    function uploadedFile($item) {
        return yii\web\UploadedFile::getInstanceByName($item);
    }

    function uploadedFiles($item) {
        return yii\web\UploadedFile::getInstancesByName($item);
    }

}
