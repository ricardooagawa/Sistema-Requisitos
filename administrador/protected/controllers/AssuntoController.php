<?php

class AssuntoController extends Controller
{
    public $cod_funcionalidade = 5;

    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    //Renderiza para a página do visualizar
    public function actionVisualizar($codigo) 
    {
        //Verifica se o usuário está logado
        if (Yii::app()->user->id) 
        {
            $model = CadAssunto::model()->findByPk($codigo);

            $log = new CadLog;
            $log->gravaLog('Assunto - Requisitos', "Usuário '" . Yii::app()->user->name . "' visualizou o assunto '" . $model->des_assunto . "'");

            $this->render('visualizar', array(
                'model' => $model,
                'mensagem' => $mensagem,
            ));
        }
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Renderiza para a página do incluir
    public function actionIncluir() 
    {
        //Verifica se o usuário esta logado no sistema
        if (Yii::app()->user->id)
        {
            //Faz a instância do model
            $model = new CadProjeto;

            //Verifica existe algum dado sendo enviado por post de acordo com o model instânciado
            if (isset($_POST['CadProjeto'])) 
            {
                //Verifica se o btnClick existe nos dados enviados
                if (isset($_POST['btnClick'])) 
                {
                    //Recebe os atributos
                    $model->attributes = $_POST['CadProjeto'];
                    $model->des_projeto = $_POST['CadProjeto']['des_projeto'];
                    $model->cod_id_usuario = Yii::app()->user->id; // Preenche automaticamente o campo cod_usuÃ¡rio.
                    $model->dat_atualizacao = date('Y-m-d H:i');
                    $model->flg_ativo = $_POST['CadProjeto']['flg_ativo'];

                    //Faz a validação dos campos 
                    if ($model->validate())
                    {
                        //Faz a inclusão
                        $model->save();
                        
                        //Grava o log
                        $log = new CadLog;
                        $log->gravaLog('Projeto', "Usuário '" . Yii::app()->user->name . "' incluiu o projeto '" . $model->des_projeto . "'");

                        //Exibe mensagem de salvo com sucesso
                        Yii::app()->user->setFlash('success', 'Salvo com sucesso.');

                        //Redireciona para o Visualizar mandando como parâmetro o codigo do registro selecionado
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_projeto));
                    }
                }
            }

            //Renderiza a página do incluir
            $this->render('incluir', array(
                'model' => $model,
            ));
            
        } 
        else 
        {
            //Redireciona para site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    public function actionAlterar($codigo) 
    {
        //Verifica se o usuário esta logado no sistema
        if (Yii::app()->user->id) 
        {
            //Chama a função do loadModel, mandando como parâmetro o código.
            $model = CadAssunto::model()->findByPk($codigo);

            //Verifica se o btnClick existe nos dados enviados
            if (isset($_POST['CadProjeto'])) 
            {
                //Recebe os atributos
                $model->attributes = $_POST['CadProjeto'];
                $model->des_projeto = $_POST['CadProjeto']['des_projeto'];
                $model->cod_id_usuario = Yii::app()->user->id; // Preenche automaticamente o campo cod_usuário.
                $model->dat_atualizacao = date('Y-m-d H:i');
                $model->flg_ativo = $_POST['CadProjeto']['flg_ativo'];

                //Verifica se os dados do btnClik são POST
                if (isset($_POST['btnClick'])) 
                {
                    //Se for válido atualiza
                    if ($model->validate())
                    {
                        //Atualiza o registro		
                        $model->update();

                        $log = new CadLog;
                        $log->gravaLog('Projeto', "Usuário '" . Yii::app()->user->name . "' alterou o projeto '" . $model->des_projeto . "'");

                        //Exibe mensagem de alterado com sucesso
                        Yii::app()->user->setFlash('success', 'Alterado com sucesso.');

                        //Redireciona para o Visualizar, mandando como parâmetro o codigo do projeto
                        $this->redirect(array('Visualizar', 'codigo' => $model->cod_projeto, 'mensagem' => 'Registro Alterado com Sucesso'));
                    }
                }
            }
            //Renderiza a página do alterar
            $this->render('alterar', array(
                'model' => $model,
            ));
        } 
        else
        {
            //Redireciona para site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    public function actionExcluir($codigo)
    {
        //Verifica se o usuário está logado no sistema
        if (Yii::app()->user->id) 
        {
            //Verifica se os dados requisitados são POST
            if (Yii::app()->request->isPostRequest) 
            {
                try 
                {
                    //Deleta o registro
                    $this->loadModel($codigo)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                    //A informação recebida é exibida, caso não for direciona para o admin
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                } 
                catch (Exception $ex) 
                {
                    throw new CHttpException(400, 'Esta projeto esta vinculado a outros registros e não pode ser excluído.');
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

    //Função para buscar
    public function actionBuscar() 
    {
        //Verifica se o usuário está logado no sistema
        if (Yii::app()->user->id)
        {
            //Faz a instância da view CadProjeto, mandando como parâmetro o search
            $model = new CadProjeto('search');
            $model->unsetAttributes();

            //Verifica se os dados recebidos são do tipo POST
            if (isset($_POST['CadProjeto'])) 
            {
                //Verifica se os dados recebidos do flg_ativo no CadUnidade são do tipo POST
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

        //Verifica se o model é nulo
        if ($model === null)
            
            //Exibe um HTTP de erro
            throw new CHttpException(404, 'The requested page does not exist.');
        
        return $model;
    }

    //Verifica formulário
    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
