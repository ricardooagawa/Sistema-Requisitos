<?php

class CadPerfilFuncionalidade extends MyActiveRecord 
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
        return 'tb_cad_perfil_funcionalidade';
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
            
            'cod_perfil_funcionalidade' => Yii::t('labels', 'cod_perfil_funcionalidade'),
            'cod_perfil'                => Yii::t('labels', 'cod_perfil'),
            'cod_funcionalidade_acao'   => Yii::t('labels', 'cod_funcionalidade_acao'),
            
        );
    }

    public function getPerfilAcao($cod_perfil, $cod_funcionalidade, $cod_acao) 
    {
        $perfilfuncionalidade = CadPerfilFuncionalidade::model()->findAllBySql("select per.* from tb_cad_perfil_funcionalidade per inner join tb_bas_funcionalidade_acao fun on per.cod_funcionalidade_acao=fun.cod_funcionalidade_acao where fun.cod_funcionalidade=" . $cod_funcionalidade . " and fun.cod_acao='" . $cod_acao . "' and per.cod_perfil=" . $cod_perfil);

        if (count($perfilfuncionalidade) > 0) 
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function getPerfilFuncionalidade($cod_perfil, $cod_funcionalidade) 
    {
        if (Yii::app()->user->id) 
        {
            $perfilfuncionalidade = CadPerfilFuncionalidade::model()->findAllBySql("select per.* from tb_cad_perfil_funcionalidade per inner join tb_bas_funcionalidade_acao fun on per.cod_funcionalidade_acao=fun.cod_funcionalidade_acao where fun.cod_funcionalidade=" . $cod_funcionalidade . " and per.cod_perfil=" . $cod_perfil);

            if (count($perfilfuncionalidade) > 0) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }
}

?>