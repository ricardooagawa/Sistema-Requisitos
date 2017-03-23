<?php

class CadAssunto extends MyActiveRecord 
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
        return 'tb_cad_assunto';
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
            'cod_assunto'         => Yii::t('labels', 'cod_assunto'),
            'cod_projeto'         => Yii::t('labels', 'cod_projeto'),
            'des_assunto'         => Yii::t('labels', 'des_assunto'),
            'des_descricao'       => Yii::t('labels', 'des_descricao'),
            'dat_inicio'          => Yii::t('labels', 'dat_inicio'),
            'dat_termino'         => Yii::t('labels', 'dat_termino'),
            'dat_cadastro'        => Yii::t('labels', 'dat_cadastro'),
            'dat_atualizacao'     => Yii::t('labels', 'dat_atualizacao'),
            'cod_id_usuario'      => Yii::t('labels', 'cod_id_usuario'),
        );
    }

    public function search() 
    {
        $criteria = new CDbCriteria;

        $criteria->compare('cod_projeto', $this->cod_projeto);
        $criteria->compare('des_assunto', $this->des_assunto);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }
    
    //Filtro de busca para exibir os assuntos para resposta do usuário
    public function filtroRespostaUsuario() 
    {
        $criteria = new CDbCriteria;
        
        //Captura o código do projeto que esta associado ao usuário logado
        $cod_projeto= CadUsuario::model()->getProjeto();
        
        //Faz o join com a tb_cad_projeto
        $criteria->join=' inner join tb_cad_projeto pro on t.cod_projeto=pro.cod_projeto';
        
        //Verifica se o código do projeto é diferente de vazio 
        if(!empty($cod_projeto))
        {
            //Exibe apenas registros de acordo com o código do projeto associado ao usuário logado, com a data de inicio maior ou igual a data atual e com o projeto ativo
            $criteria->condition=' t.cod_projeto='.$cod_projeto.' AND t.dat_inicio <= NOW() AND pro.flg_ativo="S"';
        }
        else
        {   //Exibe todos registros, com a data de inicio maior ou igual a data atual e com o projeto ativo
            $criteria->condition=' t.dat_inicio <= NOW() AND pro.flg_ativo="S"';
        }
          
        $criteria->compare('t.des_assunto', $this->des_assunto, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
               'defaultOrder'=>'t.dat_cadastro desc',
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }
    
    //Retorna um valor booleano caso os requitos estejam aberto para resposta de acordo com o prazo (dat_inicio, dat_termino)
    public function getPermissaoRespostaRequito($dat_inicio, $dat_termino)
    {
        //Verifica se os parametros e recebidos estão preenchidos
        if(!empty($dat_inicio) and !empty($dat_termino))
        {
            $dat_inicio=strtotime($dat_inicio);
            $dat_termino=strtotime($dat_termino);
            $dat_atual=strtotime(date('Y-m-d H:i'));
            
            //Verifica se a data de inicio é posterior a data atual e anterior a data de termino
            if(($dat_atual > $dat_inicio) and ($dat_atual < $dat_termino))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }
}
