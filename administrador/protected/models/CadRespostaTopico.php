<?php

class CadRespostaTopico extends MyActiveRecord 
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
        return 'tb_cad_resposta_topico';
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
            
            'cod_resposta_topico'   => Yii::t('labels', 'cod_resposta_topico'),
            'cod_resposta'          => Yii::t('labels', 'cod_resposta'),
            'des_resposta_topico'   => Yii::t('labels', 'des_resposta_topico'),
            'dat_atualizacao'       => Yii::t('labels', 'dat_atualizacao'),
            'cod_id_usuario'        => Yii::t('labels', 'cod_id_usuario'),
            
        );
    }
    
    //Retorna as respostas do assunto e dos tópicos de acordo com o código do assunto, usuário e o código do tópico
    public function getRespostaTopico($cod_assunto, $cod_assunto_topico)
    {
        if(!empty($cod_assunto))
        {
            $consulta = "SELECT 
                            rest.*, 
                            resp.cod_assunto,
                            resp.cod_usuario
                        FROM 
                            tb_cad_resposta_topico rest
                        INNER JOIN
                            tb_cad_resposta resp
                        ON 
                            rest.cod_resposta=resp.cod_resposta
                        WHERE 
                            resp.cod_assunto=".$cod_assunto."
                        AND 
                            resp.cod_usuario=".Yii::app()->user->id."
                        AND
                            rest.cod_assunto_topico=".$cod_assunto_topico;
            
            $conexao = Yii::app()->db;
            $comando = $conexao->createCommand($consulta);
            $resultado = $comando->queryAll();
           
            return $resultado;        
        }
    }
}
