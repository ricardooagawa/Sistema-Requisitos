<?php

class ParametroController extends Conrroller 
{

    public $cod_funcionalidade = 3;

    public function actionConfigurar() 
    {
        if (Yii::app()->user->id) 
        {
            $mensagem = '';
            $alterado = false;
            
            if (isset($_GET['mensagem'])) 
            {
                if ($_GET['mensagem'] == 'C') 
                {
                    Yii::app()->user->setFlash('success', '<strong>Registro Salvo com Sucesso!</strong>');
                }
            }

            $model = new CadParametro;
            $parametro = CadParametro::model()->getParametro();

            if (isset($_POST['btnClick'])) 
            {
                foreach ($parametro as $cont => $registro) 
                {
                    $model = CadParametro::model()->findByPk($registro['cod_parametro']);
                    $model->val_parametro = $_POST['val_parametro' . $registro['cod_parametro']];
                    $model->cod_usuario = Yii::app()->user->id; // insere e atualiza para o funcionario logado 
                    $model->dat_atualizacao = date('Ymd H:i'); // insere e atualiza para data e hora atual
                    
                    if ($model->val_parametro != $registro['val_parametro']) 
                    {
                        if ($model->update()) 
                        {
                            $log = new CadLog;
                            $log->gravaLog('Parâmetros', "Usuário '" . Yii::app()->user->name . "' alterou o Parâmetro '" . $model->des_parametro . "' para '" . $model->val_parametro . "'");
                            $alterado = true;
                        }
                    }
                }
                if ($alterado) 
                {
                    $this->redirect(Yii::app()->createURL('Parametro/Configurar', array('mensagem' => 'C')));
                }
            }
            
            $this->render('configurar', array('model' => $model, 'parametro' => $parametro, 'mensagem' => $mensagem));
            
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

}
