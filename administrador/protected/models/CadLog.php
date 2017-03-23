<?php

class CadLog extends MyActiveRecord 
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
        return 'tb_cad_log';
    }

    public function rules() 
    {
        return array(
            array('', 'required'),
            array('', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() 
    {
        return array(
            
            'des_funcionalidade'    => Yii::t('labels', 'des_funcionalidade'),
            'des_log'               => Yii::t('labels', 'des_log'),
            'des_ip'                => Yii::t('labels', 'des_ip'),
            'dat_atualizacao'       => Yii::t('labels', 'dat_atualizacao'),
            'cod_usuario'           => Yii::t('labels', 'cod_usuario'),
            
        );
    }

    public function relatorio() 
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'inner join tb_cad_usuario usu on t.cod_usuario=usu.cod_usuario';
        $criteria->compare('t.des_log', $this->des_log, true);
        $criteria->compare('t.cod_usuario', $this->cod_usuario, true);

        $criteria->order = 't.dat_atualizacao DESC';
        
        if ($this->dat_atualizacao != '') 
        {
            $dat_atualizacao = split(' - ', $this->dat_atualizacao);
            $dd = substr($dat_atualizacao[0], 0, 2);
            $mm = substr($dat_atualizacao[0], 3, 2);
            $yy = substr($dat_atualizacao[0], 6, 4);

            $dat_inicio = $yy . '-' . $mm . '-' . $dd . ' 00:00:00';
            
            if (isset($dat_atualizacao[1])) 
            {
                $dd1 = substr($dat_atualizacao[1], 0, 2);
                $mm1 = substr($dat_atualizacao[1], 3, 2);
                $yy1 = substr($dat_atualizacao[1], 6, 4);
                $dat_termino = $yy1 . '-' . $mm1 . '-' . $dd1 . ' 23:59:59';
            } 
            else 
            {
                $dat_termino = $yy . '-' . $mm . '-' . $dd . ' 23:59:59';
            }
            
            $criteria->addBetweenCondition('t.dat_atualizacao', $dat_inicio, $dat_termino);
        }
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function gravaLog($des_funcionalidade, $des_log) 
    {
        $this->des_funcionalidade = $des_funcionalidade;
        $this->des_log = $des_log;
        $this->des_ip = $_SERVER['REMOTE_ADDR'];
        $this->cod_usuario = Yii::app()->user->id;
        $this->dat_atualizacao = date('Y-m-d H:i');
        $this->save();
    }
}
