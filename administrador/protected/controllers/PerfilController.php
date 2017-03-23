<?php

class PerfilController extends Controller 
{
    public $cod_funcionalidade = 1;

    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function actionVisualizar($codigo) 
    {
        if (Yii::app()->user->id)
        {
            $model = CadPerfil::model()->findByPk($codigo);

            $log = new CadLog;
            $log->gravaLog('Perfil de Acesso', "Usuário '" . Yii::app()->user->name . "' visualizou o Perfil de Acesso '" . $model->des_perfil . "'");

            $this->render('visualizar', array(
                'model' => $model
            ));
        } 
        else
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //função para incluir um perfil
    public function actionIncluir() 
    {
        if (Yii::app()->user->id) 
        {
            $model = new CadPerfil;
            $perfilfuncionalidades = new CadPerfilFuncionalidade;

            if (isset($_POST['CadPerfil'])) 
            {
                //atributos CadPerfil
                $model->attributes = $_POST['CadPerfil'];
                $model->des_perfil = $_POST['CadPerfil']['des_perfil'];
                $model->dat_atualizacao = date('Y-m-d H:i');  //insere data e hora atual
                $model->cod_usuario = Yii::app()->user->id; //insere o codigo do funcionario logado, que fez a inclusão de um novo registro
               
                if ($model->validate()) 
                {
                    try 
                    {
                        $model->save();

                        $log = new CadLog;
                        $log->gravaLog('Perfil de Acesso', "Usuário '" . Yii::app()->user->name . "' incluiu o Perfil de Acesso '" . $model->des_perfil . "'");

                        $funcionalidadeacao = BasFuncionalidadeAcao::model()->findAll();
                        
                        foreach ($funcionalidadeacao as $chave => $acao) 
                        {
                            //Verifica se a funcionalidade_acao foi checada
                            if ($_POST['cod_acao' . $acao->cod_funcionalidade_acao] == 1)
                            {
                                $modelPerfilFunc = new CadPerfilFuncionalidade;
                                $modelPerfilFunc->cod_funcionalidade_acao = $acao->cod_funcionalidade_acao;
                                $modelPerfilFunc->cod_perfil = $model->cod_perfil;
                                $modelPerfilFunc->save();
                            }
                        }

                        Yii::app()->user->setFlash('success', 'Registro salvo com sucesso');
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_perfil));
                        
                    } 
                    catch (Exception $ex)
                    {
                        $model->addErrors(array('des_perfil' => 'Este perfil já foi cadastrado.'));
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

    //Função para alterar um perfil
    public function actionAlterar($codigo) 
    {
        if (Yii::app()->user->id)
        {
            $model = CadPerfil::model()->findByPk($codigo);
            $perfilfuncionalidades = CadPerfilFuncionalidade::model()->findAllBySQL("select * from tb_cad_perfil_funcionalidade where cod_perfil=" . $codigo);

            if (isset($_GET['mensagem'])) 
            {
                $mensagem = $_GET['mensagem'];
                $_GET['mensagem'] = '';
            } 
            else 
            {
                $mensagem = '';
            }

            if (isset($_POST['CadPerfil'])) 
            {
                // atributos CadPerfil
                $model->attributes = $_POST['CadPerfil'];
                $model->des_perfil = $_POST['CadPerfil']['des_perfil'];
                $model->dat_atualizacao = date('Y-m-d H:i');   //atualiza data e hora atual
                $model->cod_usuario = Yii::app()->user->id; //atualiza codigo do funcionario logado que fez a alteração

                if ($model->validate()) 
                {
                    try 
                    {
                        $model->save();

                        $log = new CadLog;
                        $log->gravaLog('Perfil de Acesso', "Usuário '" . Yii::app()->user->name . "' alterou o Perfil de Acesso '" . $model->des_perfil . "'");

                        if (!empty($perfilfuncionalidades))
                        {
                            foreach ($perfilfuncionalidades as $contador => $perfilfuncionalidade) 
                            {
                                $perfilfuncionalidade->delete();
                            }
                        }

                        $funcionalidadeacao = BasFuncionalidadeAcao::model()->findAll();
                        
                        foreach ($funcionalidadeacao as $chave => $acao) 
                        {
                            //Verifica se a funcionalidade_acao foi checada
                            if ($_POST['cod_acao' . $acao->cod_funcionalidade_acao] == 1) 
                            {
                                $modelPerfilFunc = new CadPerfilFuncionalidade;
                                $modelPerfilFunc->cod_funcionalidade_acao = $acao->cod_funcionalidade_acao;
                                $modelPerfilFunc->cod_perfil = $model->cod_perfil;
                                $modelPerfilFunc->save();
                            }
                        }

                        Yii::app()->user->setFlash('success', 'Registro alterado com sucesso');
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_perfil));
                        
                    } 
                    catch (Exception $ex)
                    {
                        $model->addErrors(array('des_perfil' => 'Este perfil já foi cadastrado.'));
                    }
                }
            }

            $this->render('alterar', array('model' => $model, 'mensagem' => $mensagem));
            
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Função para deletar um perfil
    public function actionExcluir($codigo)
    {
        if (Yii::app()->user->id)
        {
            if (Yii::app()->request->isPostRequest) 
            {
                try 
                {
                    $modelPerfil = CadPerfil::model()->findByPk($codigo);
                    $this->loadModel($codigo)->delete();

                    $log = new CadLog;
                    $log->gravaLog('Perfis de Acesso', "Usuário '" . Yii::app()->user->name . "' excluiu o perfil '" . $modelPerfil->des_perfil . "'");
                }
                catch (Exception $ex) 
                {
                    throw new CHttpException(400, 'Este perfil está associado a um usuário, portanto não poderá ser excluído.');
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

    //Função para buscar um perfil
    public function actionBuscar()
    {
        if (Yii::app()->user->id) 
        {
            $model = new CadPerfil('search');
            $model->unsetAttributes();

            if (isset($_POST['CadPerfil']))
            {
                $model->attributes = $_POST['CadPerfil'];
                $model->des_perfil = $_POST['CadPerfil']['des_perfil'];
            }

            $model->des_perfil = Yii::app()->user->getState('filtro_perfil_des_perfil');

            Yii::app()->user->setState('filtro_perfil_des_perfil', $model->des_perfil);
            $this->render('grid', array('model' => $model));
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Carrega o model
    public function loadModel($codigo)
    {
        $model = CadPerfil::model()->findByPk($codigo);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        
        return $model;
    }

    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') 
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
