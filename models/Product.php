<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord {

    // переопределяем метод, чтобы изменить имя таблицы
    public static function tableName() {
        return 'izdelie';
    }

    // правила для проверки формы перед отправкой
    public function rules() {
        return [
            [['name', 'type_material', 'length', 'height', 'width'], 'required',
                'message' => 'Заполните это поле'],
            [['length', 'height', 'width'], 'integer',
                'message' => 'Допустыме символы: 0-9'],
            [['length', 'height', 'width'], 'integer', 'max'     => 9999,
                'message' => 'Длина не должна превышать 4 символов'],
            [['name', 'type_material'], 'string', 'length'   => [2, 20],
                'message'  => 'Длина должна быть от 2 до 20 символов',
                'tooShort' => 'Длина должна быть минимум 2 символа',
                'tooLong'  => 'Длина не должна превышать 20 символов.']
        ];
    }

    // имена полей
    public function attributeLabels() {
        return [
            'id'            => 'ID',
            'name'          => 'Изделие',
            'type_material' => 'Материал',
            'length'        => 'Длина',
            'height'        => 'Высота',
            'width'         => 'Ширина',
        ];
    }

}
