<?php

class SiteController extends Controller 
{

    //Actions
    public function actions() 
    {
        return array(
            //CAPTCHA
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    //Exibe a página inicial
    public function actionIndex() 
    {
        if (Yii::app()->user->id) 
        {
            $this->render('index');
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Trata mensagens de erro
    public function actionError() 
    {
        if (Yii::app()->user->id) 
        {
            if ($error = Yii::app()->errorHandler->error) 
            {
                if (Yii::app()->request->isAjaxRequest)
                    echo $error['message'];
                else
                    $this->render('error', $error);
            }
        }
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }

    //Exibe a tela de login
    public function actionLogin() 
    {
        $model = new LoginForm;
        $log = new CadLog;
        
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') 
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) 
        {
            $model->attributes = $_POST['LoginForm'];

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::app()->session['login'] = $_POST['LoginForm']['username'];

                $url = Yii::app()->user->returnUrl;
                if ($url == '')
                    $url = Yii::app()->user->getReturnUrl();
                if ($url == '')
                    $url = Yii::app()->createURL('site/index');
                $log->gravaLog('Login', "Usuário '" . $_POST['LoginForm']['username'] . "' logou no sistema", $_SERVER['REMOTE_ADDR']);
                $this->redirect($url);
            }
            else 
            {
                $falhas = '';
                if ($model->getError('username') != '') 
                {
                    $falhas = $model->getError('username');
                }
                if ($model->getError('password') != '') 
                {
                    if ($falhas == '')
                        $falhas = $model->getError('password');
                    else
                        $falhas.=' - ' . $model->getError('password');
                }
                if ($model->getError('verifyCode') != '') 
                {
                    if ($falhas == '')
                        $falhas = $model->getError('verifyCode');
                    else
                        $falhas.=' - ' . $model->getError('verifyCode');
                }
                
                //Transforma o entitie do html para caracter especial
                $falhas = Sistema::getEntitiesParaEspecialCaracter($falhas);
                               
                
                $log->gravaLog('Login', "Tentativa de Login para o usuário '" . $_POST['LoginForm']['username'] . "' teve os seguintes erros " . $falhas, $_SERVER['REMOTE_ADDR']);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    //Logoff
    public function actionLogout() 
    {
        $log = new CadLog;
        $log->gravaLog('Login', "O Usuário '" . Yii::app()->user->name . "' saiu do sistema.", $_SERVER['REMOTE_ADDR']);
        
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
