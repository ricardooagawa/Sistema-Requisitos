<?php

class LoginForm extends CFormModel 
{

    public $username;
    public $password;
    public $verifyCode;
    private $_identity;

    public function rules() 
    {
        return array(
            array('username, password, verifyCode', 'required'),
            array('password', 'authenticate'),
                //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    public function attributeLabels() 
    {
        return array(
            'username' => 'Login',
            'password' => 'Senha',
            'verifyCode' => 'Código de Verificação',
        );
    }

    public function authenticate($attribute, $params) 
    {
        if (!$this->hasErrors()) 
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            
            if (!$this->_identity->authenticate()) 
            {
                $this->addError('password', 'Usuário ou senha incorretos.');
            }
        }
    }

    public function login() 
    {
        if ($this->_identity === null) 
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) 
        {
            Yii::app()->user->login($this->_identity);
            return true;
        } 
        else
        {
            return false;
        }
            
    }

}
