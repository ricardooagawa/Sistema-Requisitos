<?php

class BasFuncionalidade extends MyActiveRecord 
{
    public function getDbConnection() 
    {
        return self::getGroupDbConnection();
    }

    public static function model($className = __CLASS__) 
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tb_bas_funcionalidade';
    }

    public function rules() 
    {
        return array(
            array('', 'required'),
        );
    }

    public function search() 
    {
        $criteria = new CDbCriteria;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function attributeLabels() 
    {
        return array(
            'cod_funcionalidade'    => Yii::t('labels', 'cod_funcionalidade'),
            'des_funcionalidade'    => Yii::t('labels', 'des_funcionalidade'),
            'des_icone'             => Yii::t('labels', 'des_icone'),
            'des_link'              => Yii::t('labels', 'des_link'),
            'flg_ativo'             => Yii::t('labels', 'flg_ativo'),
        );
    }
}

?>