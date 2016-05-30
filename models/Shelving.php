<?php

namespace app\models;

use yii\db\ActiveRecord;

class Shelving extends ActiveRecord {
    
    // переопределяем метод, чтобы изменить имя таблицы
     public static function tableName() {
        return 'shelving';
    }

    // правила для проверки формы перед отправкой
    public function rules() {
        return [
            [['name', 'whereabouts'], 'required',
                'message' => 'Заполните это поле'],
            [['name'], 'string', 'length'   => [2, 8],
                'message'  => 'Длина должна быть от 2 до 8 символов',
                'tooShort' => 'Длина должна быть минимум 2 символа',
                'tooLong'  => 'Длина не должна превышать 8 символов.'],
            [['whereabouts'], 'string', 'length'   => [2, 40],
                'message'  => 'Длина должна быть от 2 до 40 символов',
                'tooShort' => 'Длина должна быть минимум 2 символа',
                'tooLong'  => 'Длина не должна превышать 40 символов.']
        ];
    }
    
    // имена полей
    public function attributeLabels() {
        return [
            'id'   => 'ID',
            'name' => 'Стелаж',
            'whereabouts' => 'Местоположение'
        ];
    }
}
