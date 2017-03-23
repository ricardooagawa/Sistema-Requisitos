<?php

class CadProjeto extends MyActiveRecord 
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
        return 'tb_cad_projeto';
    }

    public function rules()
    {
        return array(
            //Campos requisitados
            array('des_projeto', 'required'),
         
            array('customer_group_id, customer_group_code, tax_class_id, des_startup_page', 'safe', 'on' => 'search'),
        );
    }

    //Atribui o valor das labels
    public function attributeLabels()
    {
        //Associa os campos com os valores atribuidos no label
        return array(
            'cod_projeto'                => Yii::t('labels', 'cod_projeto'),
            'des_projeto'                => Yii::t('labels', 'des_projeto'),
            'cod_id_usuario'             => Yii::t('labels', 'cod_id_usuario'),
            'dat_atualizacao'            => Yii::t('labels', 'dat_atualizacao'),
            'flg_ativo'                  => Yii::t('labels', 'flg_ativo'),
        );
    }

    //Função buscar
    public function search() 
    {
        //Faz uma instância
        $criteria = new CDbCriteria;

        $criteria->compare('des_projeto', $this->des_projeto, true);
        $criteria->compare('flg_ativo', $this->flg_ativo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    //Função que o retorna a o projeto
    public function getProjeto($var)
    {
        if (!empty($var))
        {
            $consulta = "select des_projeto from tb_cad_projeto where cod_projeto=" . $var;
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
            if ($resultado[0]) 
            {
                $retorno = $resultado[0]['des_projeto'];
            } 
            else 
            {
                $retorno = null;
            }
        } 
        else
        {
            $retorno = 'Todos';
        }

        return $retorno;
    }
}
