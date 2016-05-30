<?php

namespace app\models;

use yii\db\ActiveRecord;

class Manufacturer extends ActiveRecord {

    // переопределяем метод, чтобы изменить имя таблицы
    public static function tableName() {
        return 'manufacturer';
    }

    // правила для проверки формы перед отправкой
    public function rules() {
        return [
            [['name', 'city'], 'required',
                'message' => 'Заполните это поле'],
            [['name'], 'string', 'length'   => [2, 15],
                'message'  => 'Длина должна быть от 2 до 15 символов',
                'tooShort' => 'Длина должна быть минимум 2 символа',
                'tooLong'  => 'Длина не должна превышать 15 символов.'],
            [['city'], 'string', 'length'   => [2, 20],
                'message'  => 'Длина должна быть от 2 до 20 символов',
                'tooShort' => 'Длина должна быть минимум 2 символа',
                'tooLong'  => 'Длина не должна превышать 20 символов.']
        ];
    }
    
    // имена полей
    public function attributeLabels() {
        return [
            'id'   => 'ID',
            'name' => 'Изготовитель',
            'city' => 'Город'
        ];
    }

}
