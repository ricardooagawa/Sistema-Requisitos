<?php
class MyActiveRecord extends CActiveRecord {

    public static $db = null;
 
    protected static function getGroupDbConnection()
    {
        if (self::$db !== null)
            return self::$db;
        else
        {
        	self::$db = Yii::app()->db;
            if (self::$db instanceof CDbConnection)
            {
                self::$db->setActive(true);
                return self::$db;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}