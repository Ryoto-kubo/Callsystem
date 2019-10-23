<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{

    //laravelでは必要
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const SEAT_ID_TABLE   = 1;
    const SEAT_ID_BOX     = 2;
    const SEAT_ID_COUNTER = 3;
    const SEAT_ID_EITHER  = 4;

    const SMOKE_ID_SMOKING    = 1;
    const SMOKE_ID_NOTSMOKING = 2;
    const SMOKE_ID_EITHER     = 3;
    
    /**
     * @return array
     */
    public static function getEatTypeIdOptions()
    {
        $options                        = array();
        $options[self::SEAT_ID_TABLE]   = 'テーブル席';
        $options[self::SEAT_ID_BOX]     = 'ボックス席';
        $options[self::SEAT_ID_COUNTER] = 'カウンター席';
        $options[self::SEAT_ID_EITHER]  = 'どこでも良い';

        return $options;
    }

    /**
     * @return array
     */
    public static function getSmokeTypeIdOptions()
    {
        $options                            = array();
        $options[self::SMOKE_ID_SMOKING]    = '喫煙席';
        $options[self::SMOKE_ID_NOTSMOKING] = '禁煙席';
        $options[self::SMOKE_ID_EITHER]     = 'どちらでも良い';

        return $options;
    }

    public static function getEatCaptionById($id)
    {
        $options = static::getEatTypeIdOptions();

        return $options[$id] ?? null;
    }

    public static function getSmokeCaptionById($id)
    {
        $options = static::getSmokeTypeIdOptions();

        return $options[$id] ?? null;
    }

    protected $guarded = array('id');
    
    // テーブル名の指定
    protected $table   = 'reception';
}
