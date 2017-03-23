<?php

class CadUsuario extends MyActiveRecord 
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
        return 'tb_cad_usuario';
    }

    public function rules() 
    {
        return array(
            array('cod_perfil, nom_usuario, des_login, des_senha', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('customer_group_id, customer_group_code, tax_class_id, des_startup_page', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() 
    {
        return array(
            'cod_usuario'        => Yii::t('labels', 'cod_usuario'),
            'cod_perfil'         => Yii::t('labels', 'cod_perfil'),
            'cod_projeto'        => Yii::t('labels', 'cod_projeto'),
            'nom_usuario'        => Yii::t('labels', 'nom_usuario'),
            'des_email'          => Yii::t('labels', 'des_email'),
            'des_login'          => Yii::t('labels', 'des_login'),
            'des_senha'          => Yii::t('labels', 'des_senha'),
            'flg_ativo'          => Yii::t('labels', 'flg_ativo'),
            'dat_cadastro'       => Yii::t('labels', 'dat_cadastro'),
            'dat_atualizacao'    => Yii::t('labels', 'dat_atualizacao'),
            'cod_id_usuario'     => Yii::t('labels', 'cod_id_usuario'),
        );
    }

    public function search() 
    {
        $criteria = new CDbCriteria;

        $criteria->compare('nom_usuario', $this->nom_usuario, true);
        $criteria->compare('cod_projeto', $this->cod_projeto, true);
        $criteria->compare('cod_perfil', $this->cod_perfil, true);
        $criteria->compare('flg_ativo', $this->flg_ativo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }
    
    //Função que o retorna o perfil do usuário
    public function getPerfil($var) 
    {
        if(!empty($var))
        {
            $consulta = "select des_perfil from tb_cad_perfil where cod_perfil=" . $var;
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
            if ($resultado[0]) {
                $retorno = $resultado[0]['des_perfil'];
            } else {
                $retorno = null;
            }

            return $retorno;
        }
    }

    public function getUsuario($var)
    {
        if (!empty($var))
        {
            $consulta = "select nom_usuario from tb_cad_usuario where cod_usuario=" . $var;
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
            if ($resultado[0]) 
            {
                $retorno = $resultado[0]['nom_usuario'];
            } 
            else 
            {
                $retorno = null;
            }

            return $retorno;
        }
    }
    
    //Retorna o código do projeto associado ao usuário
    public function getProjeto()
    {
        $cod_usuario= Yii::app()->user->id;
        
        $consulta = "select cod_projeto from tb_cad_usuario where cod_usuario=" . $cod_usuario;
        $conexao = Yii::app()->db;
        $comando = $conexao->createCommand($consulta);
        $resultado = $comando->queryAll();
        if ($resultado[0]) 
        {
            $retorno = $resultado[0]['cod_projeto'];
        } 
        else 
        {
            $retorno = null;
        }

        return $retorno;        
    }
    
    //Retorna o código do projeto associado ao usuário
    public function getNomeProjeto()
    {
        $cod_usuario= Yii::app()->user->id;
        
        $consulta = "select pro.des_projeto from tb_cad_usuario usu inner join tb_cad_projeto pro on usu.cod_projeto=pro.cod_projeto where cod_usuario=" . $cod_usuario;
        $conexao = Yii::app()->db;
        $comando = $conexao->createCommand($consulta);
        $resultado = $comando->queryAll();
        
        if (!empty($resultado)) 
        {
            $retorno = $resultado[0]['des_projeto'];
        } 
        else 
        {
            $retorno = 'Todos';
        }

        return $retorno;        
    }
}
