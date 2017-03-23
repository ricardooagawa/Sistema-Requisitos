<?php

class RespostaUsuarioController extends Controller
{
    public $cod_funcionalidade = 4;

    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    
    public function actionResponder($codigo) 
    {
        //Verifica se o usu�rio esta logado no sistema
        if (Yii::app()->user->id) 
        {
           //Captura os atributos e topicos associados ao assunto selecionado 
           $modelAssuntoTopico= CadAssuntoTopico::model()->getAssuntoTopico($codigo);
           
           //Verifica se algum dado foi enviado do formul�rio
           if(!empty($_POST))
           {
               $topico=$_POST['topico'];
                              
               //Verifica se existe alguma resposta
               if(!empty($topico))
               {
                    //Verifica se existe alguma resposta de acordo com o assunto e o usu�rio logado
                    $modelRespostaAlterar=CadResposta::model()->findBySql("SELECT * FROM tb_cad_resposta WHERE cod_usuario=".Yii::app()->user->id." AND cod_assunto=".$modelAssuntoTopico[0]['cod_assunto']);
                   
                    //Verifica se a pesquisa retornou algum registro 
                    if(!empty($modelRespostaAlterar))
                    {
                        //Faz a altera��o da resposta do assunto
                        $modelRespostaAlterar->cod_id_usuario=Yii::app()->user->id;
                        $modelRespostaAlterar->dat_atualizacao=date('Y-m-d H:i');
                        $modelRespostaAlterar->update();
                        
                        $cod_resposta=$modelRespostaAlterar->cod_resposta;
                    }
                    else
                    {
                        //Faz a inclus�o da resposta do assunto
                        $modelRespostaIncluir= new CadResposta;
                        $modelRespostaIncluir->cod_assunto=$modelAssuntoTopico[0]['cod_assunto'];
                        $modelRespostaIncluir->cod_usuario=Yii::app()->user->id;
                        $modelRespostaIncluir->cod_id_usuario=Yii::app()->user->id;
                        $modelRespostaIncluir->dat_atualizacao=date('Y-m-d H:i');
                        $modelRespostaIncluir->save();
                        
                        $cod_resposta=$modelRespostaIncluir->cod_resposta;
                    }
                       
                    //Faz um contador para fazer a inclus�o das respostas dos t�picos
                    foreach($topico as $cod_assunto_topico=>$resposta)
                    {
                        if(!empty($modelRespostaAlterar->cod_resposta))
                        {
                            //Verifica se o t�pico que esta passando no cursor j� foi respondido
                            $modelRespostaTopicoAlterar=  CadRespostaTopico::model()->findBySql("SELECT * FROM tb_cad_resposta_topico WHERE cod_resposta=".$modelRespostaAlterar->cod_resposta." AND cod_assunto_topico=".$cod_assunto_topico);
                            
                            //Verifica se a consulta retornou algum registro
                            if(!empty($modelRespostaTopicoAlterar))
                            {
                                //Verifica se a resposta do t�pico que esta passando no cursor foi preenchida
                                if(!empty($resposta['des_resposta_topico']))
                                {
                                    //Verifica se a resposta cadastrada � diferente da digitada pelo formul�rio
                                    if($resposta['des_resposta_topico'] != $modelRespostaTopicoAlterar->des_resposta_topico)
                                    {
                                        //Faz a altera��o da resposta do t�pico
                                        $modelRespostaTopicoAlterar->des_resposta_topico=$resposta['des_resposta_topico'];
                                        $modelRespostaTopicoAlterar->cod_id_usuario=Yii::app()->user->id;
                                        $modelRespostaTopicoAlterar->dat_atualizacao=date('Y-m-d H:i');
                                        $modelRespostaTopicoAlterar->update();
                                    }
                                }
                                else
                                {
                                    //Faz a exclus�o caso a resposta deste t�pico exista no banco de dados e a resposta n�o foi preenchida (esta vazia)
                                    $modelRespostaTopicoAlterar->delete();
                                }
                            }
                            else
                            {
                                //Verifica se a resposta do t�pico que esta passando no cursor foi preenchida
                                if(!empty($resposta['des_resposta_topico']))
                                {
                                    //Faz a inclus�o da resposta do t�pico
                                    $modelRespostaTopicoIncluir= new CadRespostaTopico;
                                    $modelRespostaTopicoIncluir->cod_resposta=$cod_resposta;
                                    $modelRespostaTopicoIncluir->cod_assunto_topico=$cod_assunto_topico;
                                    $modelRespostaTopicoIncluir->des_resposta_topico=$resposta['des_resposta_topico'];
                                    $modelRespostaTopicoIncluir->cod_id_usuario=Yii::app()->user->id;
                                    $modelRespostaTopicoIncluir->dat_atualizacao=date('Y-m-d H:i');
                                    $modelRespostaTopicoIncluir->save();
                                }
                            }
                        }
                        else
                        {
                            //Verifica se a resposta do t�pico que esta passando no cursor foi preenchida
                            if(!empty($resposta['des_resposta_topico']))
                            {
                                //Faz a inclus�o da resposta do t�pico
                                $modelRespostaTopicoIncluir= new CadRespostaTopico;
                                $modelRespostaTopicoIncluir->cod_resposta=$cod_resposta;
                                $modelRespostaTopicoIncluir->cod_assunto_topico=$cod_assunto_topico;
                                $modelRespostaTopicoIncluir->des_resposta_topico=$resposta['des_resposta_topico'];
                                $modelRespostaTopicoIncluir->cod_id_usuario=Yii::app()->user->id;
                                $modelRespostaTopicoIncluir->dat_atualizacao=date('Y-m-d H:i');
                                $modelRespostaTopicoIncluir->save();
                            }
                        }
                    }
                    
                    $log = new CadLog;
                    $log->gravaLog('Requisitos - Resposta do Usu�rio', "Usu�rio '" . Yii::app()->user->name . "' respondeu os requitos do assunto '" . $modelAssuntoTopico[0]['des_assunto'] . "'");
                    
                    //Mensagem de salvo comm sucesso
                    Yii::app()->user->setFlash('success', 'Registro salvo com sucesso');
               }
           }
           
           $this->render('responder', array('modelAssuntoTopico' => $modelAssuntoTopico));
        } 
        else
        {
            //Redireciona para site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Fun��o para buscar
    public function actionBuscar() 
    {
        //Verifica se o usu�rio est� logado no sistema
        if (Yii::app()->user->id)
        {
            $model = new CadAssunto('filtroRespostaUsuario');
            $model->unsetAttributes();
            
            if (isset($_POST['CadAssunto'])) 
            {
                //Recebe atributos
                $model->attributes = $_POST['CadAssunto'];
                $model->des_assunto = $_POST['CadAssunto']['des_assunto'];
            } 
            else 
            { 
                //Retorna os dados
                $model->des_assunto = Yii::app()->user->getState('filtro_assunto_des_assunto');
            }
            
            Yii::app()->user->setState('filtro_assunto_des_assunto', $model->des_assunto);
           
            //Renderiza o grid
            $this->render('grid', array('model' => $model));
        }
        else
        {
            //Redireciona para o site/login
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }
}
