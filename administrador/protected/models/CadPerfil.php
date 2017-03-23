<?php

class CadPerfil extends MyActiveRecord 
{
    public $chkSeleciona;

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
        return 'tb_cad_perfil';
    }

    public function rules() 
    {
        return array(
            array('des_perfil', 'required'),
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
            'cod_perfil'        => Yii::t('labels', 'cod_perfil'),
            'des_perfil'        => Yii::t('labels', 'des_perfil'),
            'dat_atualizacao'   => Yii::t('labels', 'dat_atualizacao'),
            'cod_usuario'       => Yii::t('labels', 'cod_usuario'),
        );
    }

    public function getPerfilLabels($var) 
    {
        if(!empty($var))
        {
            $consulta = "select * from tb_bas_funcionalidade where cod_funcionalidade='" . $var . "' order by cod_funcionalidade asc";
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
            if ($resultado[0]) 
            {
                $retorno = $resultado;
            } 
            else 
            {
                $retorno = null;
            }

            return $retorno;
        }
    }

    public function getPerfilLabelAll($var)
    {
        if(!empty($var))
        {
            $consulta = "select * from tb_bas_funcionalidade order by cod_funcionalidade asc";
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
            if ($resultado[0])
            {
                $retorno = $resultado;
            }
            else 
            {
                $retorno = null;
            }

            return $retorno;
        }
    }
}

?>