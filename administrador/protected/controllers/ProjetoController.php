<?php

class ProjetoController extends Controller
{
    public $cod_funcionalidade = 3;

    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    //C�digo do visualizar, renderiza a pagina do visualizar
    public function actionVisualizar($codigo) 
    {
        //Verifica se o usu�rio est� ativo
        if (Yii::app()->user->id) 
        {
            $model = CadProjeto::model()->findByPk($codigo);

            $log = new CadLog;
            $log->gravaLog('Projeto', "Usu�rio '" . Yii::app()->user->name . "' visualizou o projeto '" . $model->des_projeto . "'");

            $this->render('visualizar', array('model' => $model));
        }
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //C�digo do Incluir, renderiza e faz a inclus�o da unidade
    public function actionIncluir() 
    {
        //Verifica se o usu�rio esta logado no sistema
        if (Yii::app()->user->id)
        {
            //Faz a inst�ncia do model CadUnidade
            $model = new CadProjeto;

            //Verifica se o model CadUnidade est� recebendo dados por POST
            if (isset($_POST['CadProjeto'])) 
            {
                //Verifica se o btnClick est� recebendo dados POST
                if (isset($_POST['btnClick'])) 
                {
                    //Recebe os atributos
                    $model->attributes = $_POST['CadProjeto'];
                    $model->des_projeto = $_POST['CadProjeto']['des_projeto'];
                    $model->cod_id_usuario = Yii::app()->user->id; // Preenche automaticamente o campo cod_usuário.
                    $model->dat_atualizacao = date('Y-m-d H:i');
                    $model->flg_ativo = $_POST['CadProjeto']['flg_ativo'];

                    //Se as informa��es forem v�lidas, salvar e direcionar para a p�gina do Visualizar.
                    if ($model->validate())
                    {
                        //Faz a inclus�o da unidade
                        $model->save();

                        $log = new CadLog;
                        $log->gravaLog('Projeto', "Usu�rio '" . Yii::app()->user->name . "' incluiu o projeto '" . $model->des_projeto . "'");

                        //Exibe mensagem de salvo com sucesso
                        Yii::app()->user->setFlash('success', 'Salvo com sucesso.');

                        //Redireciona para o Visualizar mandando como par�metro o codigo do projeto.
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_projeto));
                    }
                }
            }

            //Renderiza a p�gina do incluir
            $this->render('incluir', array('model' => $model));
            
        } 
        else 
        {
            //Redireciona para site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    public function actionAlterar($codigo) 
    {
        //Verifica se o usu�rio esta logado no sistema
        if (Yii::app()->user->id) 
        {
            //Chama a fun��o do loadModel, mandando como par�metro o c�digo.
            $model = $this->loadModel($codigo);

            //Verifica se os dados recebidos da view CadUnidade s�o do tipo POST
            if (isset($_POST['CadProjeto'])) 
            {
                //Recebe os atributos
                $model->attributes = $_POST['CadProjeto'];
                $model->des_projeto = $_POST['CadProjeto']['des_projeto'];
                $model->cod_id_usuario = Yii::app()->user->id; // Preenche automaticamente o campo cod_usu�rio.
                $model->dat_atualizacao = date('Y-m-d H:i');
                $model->flg_ativo = $_POST['CadProjeto']['flg_ativo'];

                //Verifica se os dados do btnClik s�o POST
                if (isset($_POST['btnClick'])) 
                {
                    //Se for v�lido atualiza
                    if ($model->validate())
                    {
                        //Atualiza o registro		
                        $model->update();

                        $log = new CadLog;
                        $log->gravaLog('Projeto', "Usu�rio '" . Yii::app()->user->name . "' alterou o projeto '" . $model->des_projeto . "'");

                        //Exibe mensagem de alterado com sucesso
                        Yii::app()->user->setFlash('success', 'Alterado com sucesso.');

                        //Redireciona para o Visualizar, mandando como par�metro o codigo do projeto
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_projeto, 'mensagem' => 'Registro Alterado com Sucesso'));
                    }
                }
            }
            //Renderiza a p�gina do alterar
            $this->render('alterar', array('model' => $model));
        } 
        else
        {
            //Redireciona para site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    public function actionExcluir($codigo)
    {
        //Verifica se o usu�rio est� logado no sistema
        if (Yii::app()->user->id) 
        {
            //Verifica se os dados requisitados s�o POST
            if (Yii::app()->request->isPostRequest) 
            {
                try 
                {
                    //Deleta o registro
                    $this->loadModel($codigo)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                    //A informa��o recebida � exibida, caso n�o for direciona para o admin
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                } 
                catch (Exception $ex) 
                {
                    throw new CHttpException(400, 'Esta projeto esta vinculado a outros registros e n�o pode ser exclu�do.');
                }
            } 
            else
                //Exibe mensagem de erro
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        else 
        {
            //Redireciona para o site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para buscar
    public function actionBuscar() 
    {
        //Verifica se o usu�rio est� logado no sistema
        if (Yii::app()->user->id)
        {
            //Faz a inst�ncia da view CadProjeto, mandando como par�metro o search
            $model = new CadProjeto('search');
            $model->unsetAttributes();

            //Verifica se os dados recebidos s�o do tipo POST
            if (isset($_POST['CadProjeto'])) 
            {
                //Verifica se os dados recebidos do flg_ativo no CadUnidade s�o do tipo POST
                if ($_POST['CadProjeto']['flg_ativo'] != "N") 
                {
                    $options = array('checked' => 'true', 'value' => 'S', 'uncheckValue' => 'N');
                } 
                else 
                {
                    $options = array('value' => 'S', 'uncheckValue' => 'N');
                }

                //Recebe atributos
                $model->attributes = $_POST['CadProjeto'];
                $model->des_projeto = $_POST['CadProjeto']['des_projeto'];
                $model->flg_ativo = $_POST['CadProjeto']['flg_ativo'];
            } 
            else 
            { 
                if (Yii::app()->user->getState('filtro_projeto_flg_ativo') != "N") 
                {
                    $options = array('checked' => 'true', 'value' => 'S', 'uncheckValue' => 'N');
                } 
                else 
                {
                    $options = array('value' => 'S', 'uncheckValue' => 'N');
                }

                //Retorna os dados
                $model->des_projeto = Yii::app()->user->getState('filtro_projeto_des_projeto');
                $model->flg_ativo = Yii::app()->user->getState('filtro_projeto_flg_ativo');
            }
            
            Yii::app()->user->setState('filtro_projeto_des_projeto', $model->des_projeto);
            Yii::app()->user->setState('filtro_projeto_flg_ativo', $model->flg_ativo);

            //Renderiza o grid
            $this->render('grid', array('model' => $model, 'options' => $options));
        }
        else
        {
            //Redireciona para o site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Faz a pesquisa
    public function loadModel($codigo) 
    {
        //Busca a primary key
        $model = CadProjeto::model()->findByPk($codigo);

        //Verifica se o model � nulo
        if ($model === null)
            
            //Exibe um HTTP de erro
            throw new CHttpException(404, 'The requested page does not exist.');
        
        return $model;
    }

    //Verifica formul�rio
    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
