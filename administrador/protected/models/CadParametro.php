<?php

class CadParametro extends MyActiveRecord 
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
        return 'tb_cad_parametro';
    }

    public function rules() 
    {
        return array(
            array('', 'required'),
        );
    }

    public function attributeLabels() 
    {
        return array(
            
            'cod_parametro'     => Yii::t('labels', 'cod_parametro'),
            'des_parametro'     => Yii::t('labels', 'des_parametro'),
            'des_sigla'         => Yii::t('labels', 'des_sigla'),
            'val_parametro'     => Yii::t('labels', 'val_parametro'),
            'dat_atualizacao'   => Yii::t('labels', 'dat_atualizacao'),
            'cod_usuario'       => Yii::t('labels', 'cod_usuario'),
            
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

    public function getParam($var) 
    {
        $consulta = "select * from tb_cad_parametro where des_sigla='" . $var . "'";
        $conexao = Yii::app()->db;
        $comando = $conexao->createCommand($consulta);
        $resultado = $comando->queryAll();
        
        if ($resultado[0]) 
        {
            $retorno = $resultado[0]['val_parametro'];
        } 
        else 
        {
            $retorno = null;
        }

        return $retorno;
    }

}
