<?php

class UsuarioController extends Controller 
{
    public $cod_funcionalidade = 2;

    public function filters() 
    {
        return array(
            'accessControl',
        );
    }

    public function actionVisualizar($codigo)
    {
        if (Yii::app()->user->id) 
        {
            $model = CadUsuario::model()->findByPk($codigo);

            $log = new CadLog;
            $log->gravaLog('Usu�rio', "Usu�rio '" . Yii::app()->user->name . "' visualizou o usu�rio '" . CadUsuario::model()->getUsuario($codigo) . "'");

            $this->render('visualizar', array(
                'model' => $model
            ));
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para incluir um usuario
    public function actionIncluir() 
    {
        if (Yii::app()->user->id) 
        {
            $model = new CadUsuario;
            
            if (isset($_POST['CadUsuario'])) 
            {
                if (isset($_POST['btnClick'])) 
                {
                    $model->attributes = $_POST['CadUsuario'];
                    $model->cod_perfil = $_POST['CadUsuario']['cod_perfil'];
                    $model->cod_projeto = $_POST['CadUsuario']['cod_projeto'];
                    $model->nom_usuario = $_POST['CadUsuario']['nom_usuario'];
                    $model->des_email = $_POST['CadUsuario']['des_email'];
                    $model->des_login = $_POST['CadUsuario']['des_login'];
                    $model->des_senha = $_POST['CadUsuario']['des_senha'];
                    $model->cod_id_usuario = Yii::app()->user->id;
                    $model->flg_ativo = $_POST['CadUsuario']['flg_ativo'];
                    $model->dat_atualizacao = date('Y-m-d H:i');
                    $model->dat_cadastro = date('Y-m-d H:i');

                    if ($model->validate()) 
                    {
                        try
                        {
                            $model->save();

                            $log = new CadLog;
                            $log->gravaLog('Usu�rio', "Usu�rio '" . Yii::app()->user->name . "' incluiu o usu�rio '" . $model->nom_usuario . "'");

                            Yii::app()->user->setFlash('success', 'Registro salvo com sucesso.');
                            $this->redirect(array('Visualizar', 'codigo' => $model->cod_usuario));
                        } 
                        catch (Exception $ex) 
                        {
                            $model->addErrors(array('des_login' => 'Este usu�rio j� foi cadastrado.'));
                        }
                    }
                }
            }

            $this->render('incluir', array('model' => $model));
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para alterar um usuario
    public function actionAlterar($codigo)
    {
        if (Yii::app()->user->id)
        {
            $model = $this->loadModel($codigo);

            if (isset($_POST['CadUsuario'])) 
            {
                $model->attributes = $_POST['CadUsuario'];
                $model->cod_perfil = $_POST['CadUsuario']['cod_perfil'];
                $model->cod_projeto = $_POST['CadUsuario']['cod_projeto'];
                $model->nom_usuario = $_POST['CadUsuario']['nom_usuario'];
                $model->des_email = $_POST['CadUsuario']['des_email'];
                $model->des_login = $_POST['CadUsuario']['des_login'];
                $model->des_senha = $_POST['CadUsuario']['des_senha'];
                $model->cod_id_usuario = Yii::app()->user->id;
                $model->flg_ativo = $_POST['CadUsuario']['flg_ativo'];
                $model->dat_atualizacao = date('Y-m-d H:i');

                if (isset($_POST['btnClick'])) 
                {
                    if ($model->validate()) 
                    {
                        try
                        {
                            $model->update();

                            $log = new CadLog;
                            $log->gravaLog('Usu�rio', "Usu�rio '" . Yii::app()->user->name . "' alterou o usu�rio '" . $model->nom_usuario . "'");

                            Yii::app()->user->setFlash('success', 'Registro alterado com sucesso.');
                            $this->redirect(array('Visualizar', 'codigo' => $model->cod_usuario));
                        } 
                        catch (Exception $ex) {
                            $model->addErrors(array('des_login' => 'Este usu�rio j� foi cadastrado.'));
                        }
                    }
                }
            }

            $this->render('alterar', array('model' => $model));
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para deletar um usuario
    public function actionExcluir($codigo)
    {
        if (Yii::app()->user->id) 
        {
            if (Yii::app()->request->isPostRequest)
            {
                //verifica se o usuario logado � igual ao c�digo do usuario que o esta tentando excluir, se for exibir mensagem de erro
                if (Yii::app()->user->id == $codigo)
                {
                    throw new CHttpException(400, 'Voc� n�o pode excluir voc� mesmo');
                } 
                else
                {
                    $model = CadUsuario::model()->findByPk($codigo);
                    $this->loadModel($codigo)->delete();

                    $log = new CadLog;
                    $log->gravaLog('Usu�rio', "Usu�rio '" . Yii::app()->user->name . "' excluiu o usu�rio'" . $model->nom_usuario . "'", $_SERVER['REMOTE_ADDR']);
                }

                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            } 
            else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para buscar um usuario
    public function actionBuscar() 
    {
        if (Yii::app()->user->id) 
        {
            $model = new CadUsuario('search');
            $model->unsetAttributes();

            if (isset($_POST['CadUsuario']))
            {
                if ($_POST['CadUsuario']['flg_ativo'] != "N")
                {
                    $options = array('checked' => 'true', 'value' => 'S', 'uncheckValue' => 'N');
                } 
                else 
                {
                    $options = array('value' => 'S', 'uncheckValue' => 'N');
                }

                $model->attributes = $_POST['CadUsuario'];
                $model->cod_perfil = $_POST['CadUsuario']['cod_perfil'];
                $model->cod_projeto = $_POST['CadUsuario']['cod_projeto'];
                $model->nom_usuario = $_POST['CadUsuario']['nom_usuario'];
                $model->flg_ativo = $_POST['CadUsuario']['flg_ativo'];
                
            }
            else 
            {
                if (Yii::app()->user->getState('filtro_usuario_flg_ativo') != "N") 
                {
                    $options = array('checked' => 'true', 'value' => 'S', 'uncheckValue' => 'N');
                } 
                else
                {
                    $options = array('value' => 'S', 'uncheckValue' => 'N');
                }

                $model->cod_perfil = Yii::app()->user->getState('filtro_usuario_cod_perfil');
                $model->nom_usuario = Yii::app()->user->getState('filtro_usuario_nom_usuario');
                $model->cod_projeto = Yii::app()->user->getState('filtro_usuario_cod_projeto');
                $model->flg_ativo = Yii::app()->user->getState('filtro_usuario_flg_ativo');
            }

            Yii::app()->user->setState('filtro_usuario_cod_perfil', $model->cod_perfil);
            Yii::app()->user->setState('filtro_usuario_nom_usuario', $model->nom_usuario);
            Yii::app()->user->setState('filtro_usuario_cod_projeto', $model->cod_projeto);
            Yii::app()->user->setState('filtro_uaurio_flg_ativo', $model->flg_ativo);

            $this->render('grid', array('model' => $model, 'options' => $options));
            
        }
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Carrega o model usuario
    public function loadModel($codigo) 
    {
        $model = CadUsuario::model()->findByPk($codigo);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuarios-form') 
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
