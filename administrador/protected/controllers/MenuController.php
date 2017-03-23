<?php

class MenuController extends Controller 
{

    public function filters() 
    {
        return array(
            'accessControl',
        );
    }

    //Seta a página de menu para o index
    public function actionMenu() 
    {
        if (Yii::app()->user->id) 
        {
            $this->render('menu');
        } 
        else 
        {
            $this->redirect(Yii::app()->createURL('site/login'));
        }
    }
}

?>