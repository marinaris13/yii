<?php

namespace app\models;

use yii\db\ActiveRecord;

class Manufacturer extends ActiveRecord {

    public static function tableName() {
        return 'manufacturer';
    }

}
