<?php

class CadResposta extends MyActiveRecord 
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
        return 'tb_cad_resposta';
    }

    public function rules() 
    {
        return array(
            array('', 'required'),
          
            array('customer_group_id, customer_group_code, tax_class_id, des_startup_page', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() 
    {
        return array(
            
            'cod_resposta'          => Yii::t('labels', 'cod_resposta'),
            'cod_assunto'           => Yii::t('labels', 'cod_assunto'),
            'cod_usuario'           => Yii::t('labels', 'cod_usuario'),
            'des_resposta'          => Yii::t('labels', 'des_resposta'),
            'dat_atualizacao'       => Yii::t('labels', 'dat_atualizacao'),
            'cod_id_usuario'        => Yii::t('labels', 'cod_id_usuario'),
            
        );
    }    
}
