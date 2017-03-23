<?php

class CadAssuntoTopico extends MyActiveRecord 
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
        return 'tb_cad_assunto_topico';
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
            'cod_assunto_topico'    => Yii::t('labels', 'cod_assunto_topico'),
            'cod_assunto'           => Yii::t('labels', 'cod_assunto'),
            'des_topico'            => Yii::t('labels', 'des_topico'),
            'dat_atualizacao'       => Yii::t('labels', 'dat_atualizacao'),
            'cod_id_usuario'        => Yii::t('labels', 'cod_id_usuario'),
        );
    }
    
    //Retorna os atributos do assuntos e seus tópicos de acordo com o código recebido como parametro 
    public function getAssuntoTopico($cod_assunto)
    {
        if(!empty($cod_assunto))
        {
            $consulta = "SELECT * FROM
                            tb_cad_assunto_topico ast
                        INNER JOIN  
                            tb_cad_assunto ass
                        ON 
                            ast.cod_assunto=ass.cod_assunto
                        WHERE 
                            ast.cod_assunto=".$cod_assunto;
            
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
           
            return $resultado;        
        }
    }
}
