<?php

class BasFuncionalidadeAcao extends MyActiveRecord
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
        return 'tb_bas_funcionalidade_acao';
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
            'cod_funcionalidade_acao'    => Yii::t('labels', 'cod_funcionalidade_acao'),
            'cod_funcionalidade'         => Yii::t('labels', 'cod_funcionalidade'),
            'cod_acao'                   => '',
        );
    }

    public function getAcaoNome($var) 
    {
        switch ($var) {
            case 'I':
                echo 'Incluir';
                break;
            case 'A':
                echo 'Alterar';
                break;
            case 'E':
                echo 'Excluir';
                break;
            case 'L':
                echo 'Localizar';
                break;
            case 'V':
                echo 'Visualizar';
                break;
            case 'R':
                echo 'Responder';
                break;
            default:
                echo 'Aчуo Invсlida - Contate o suporte';
                break;
        }
    }
}

?>