<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    //Faz a validação do usuário de acordo com o Banco de Dados
    private $_id;
    private $_name;
    private $_perfil;

    public function authenticate()
    {
        $record = CadUsuario::model()->findByAttributes(array('des_login' => $this->username, 'flg_ativo' => 'S'));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->des_senha !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $record->cod_usuario;
            $this->setState('nome', $record->nom_usuario);
            $this->setState('perfil', $record->cod_perfil);
            $this->_name = $record->nom_usuario;
            $this->_perfil = $record->cod_perfil;
            $this->errorCode = self::ERROR_NONE;
        }
        
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getPerfil()
    {
        return $this->_perfil;
    }

}