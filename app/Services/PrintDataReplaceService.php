<?php

namespace App\Services;

class PrintDataReplaceService
{
    public static function yes_no_replace(&$options, $fieldList) {
        foreach ($options as $field => $value) {
            if (in_array($field, $fieldList))
                $options[$field] = $options[$field] ? 'Да' : 'Нет';
        }
    }
}
