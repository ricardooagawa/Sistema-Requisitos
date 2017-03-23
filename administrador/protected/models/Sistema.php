<?php

class Sistema
{       
    //Retorna data 
    public static function getExibeData($var) 
    {
        if(!empty($var))
        {
            $yyyy = substr($var, 0, 4);
            $mm = substr($var, 5, 2);
            $dd = substr($var, 8, 2);
            $hhmm = substr($var, 11, 5);

            $retorno = $dd . '/' . $mm . '/' . $yyyy;

            return $retorno;
        }
    }
    
    //Retorna data e hora
    public static function getExibeDataHora($var) 
    {
        if(!empty($var))
        {
            $yyyy = substr($var, 0, 4);
            $mm = substr($var, 5, 2);
            $dd = substr($var, 8, 2);
            $hhmm = substr($var, 11, 5);

            $retorno = $dd . '/' . $mm . '/' . $yyyy . ' ' .$hhmm;

            return $retorno;
        }
    }
       
    //Faz o tratamento para trocar o caracter especial pelo simples
    public function getRetirarCaracterEspecial($string)
    {
        if(!empty($string))
        {
            $string = str_replace("�", "A", $string);
            $string = str_replace("�", "a", $string);
            $string = str_replace("�", "A", $string);
            $string = str_replace("�", "a", $string);
            $string = str_replace("�", "A", $string);
            $string = str_replace("�", "a", $string);
            $string = str_replace("�", "A", $string);
            $string = str_replace("�", "a", $string);
            $string = str_replace("�", "A", $string);
            $string = str_replace("�", "a", $string);
            $string = str_replace("�", "a", $string);

            $string = str_replace("�", "E", $string);
            $string = str_replace("�", "e", $string);
            $string = str_replace("�", "E", $string);
            $string = str_replace("�", "e", $string);
            $string = str_replace("�", "E", $string);
            $string = str_replace("�", "e", $string);
            $string = str_replace("�", "E", $string);
            $string = str_replace("�", "e", $string);

            $string = str_replace("�", "I", $string);
            $string = str_replace("�", "i", $string);
            $string = str_replace("�", "I", $string);
            $string = str_replace("�", "i", $string);
            $string = str_replace("�", "I", $string);
            $string = str_replace("�", "i", $string);
            $string = str_replace("�", "I", $string);
            $string = str_replace("�", "i", $string);

            $string = str_replace("�", "O", $string);
            $string = str_replace("�", "o", $string);
            $string = str_replace("�", "O", $string);
            $string = str_replace("�", "o", $string);
            $string = str_replace("�", "O", $string);
            $string = str_replace("�", "o", $string);
            $string = str_replace("�", "O", $string);
            $string = str_replace("�", "o", $string);
            $string = str_replace("�", "O", $string);
            $string = str_replace("�", "o", $string);

            $string = str_replace("�", "U", $string);
            $string = str_replace("�", "u", $string);
            $string = str_replace("�", "U", $string);
            $string = str_replace("�", "u", $string);
            $string = str_replace("�", "U", $string);
            $string = str_replace("�", "u", $string);
            $string = str_replace("�", "U", $string);
            $string = str_replace("�", "u", $string);

            $string = str_replace("�", "C", $string);
            $string = str_replace("�", "c", $string);
            $string = str_replace("�", "N", $string);
            $string = str_replace("�", "n", $string);
            $string = str_replace("�", "Y", $string);
            $string = str_replace("�", "y", $string);
            
            return $string;
        }
    }
    
    //Transforma o caracter especial para entities do html
    public static function getEspecialCaracterParaEntities($string)
    {
        //faz  tratamento dos caracteres especiais 
	$string = str_replace("�", "&Aacute;", $string);
	$string = str_replace("�", "&aacute;", $string);
	$string = str_replace("�", "&Acirc;", $string);
	$string = str_replace("�", "&acirc;", $string);
	$string = str_replace("�", "&Agrave;", $string);
	$string = str_replace("�", "&agrave;", $string);
	$string = str_replace("�", "&Aring;", $string);
	$string = str_replace("�", "&aring;", $string);
	$string = str_replace("�", "&Atilde;", $string);
	$string = str_replace("�", "&atilde;", $string);
	$string = str_replace("�", "&auml;", $string);
	
	$string = str_replace("�", "&Eacute;", $string);
	$string = str_replace("�", "&eacute;", $string);
	$string = str_replace("�", "&Ecirc;", $string);
	$string = str_replace("�", "&ecirc;", $string);
	$string = str_replace("�", "&Egrave;", $string);
	$string = str_replace("�", "&egrave;", $string);
	$string = str_replace("�", "&Euml;", $string);
	$string = str_replace("�", "&euml;", $string);
	
	$string = str_replace("�", "&Iacute;", $string);
	$string = str_replace("�", "&iacute;", $string);
	$string = str_replace("�", "&Icirc;", $string);
	$string = str_replace("�", "&icirc;", $string);
	$string = str_replace("�", "&Igrave;", $string);
	$string = str_replace("�", "&igrave;", $string);
	$string = str_replace("�", "&Iuml;", $string);
	$string = str_replace("�", "&iuml;", $string);
	
	$string = str_replace("�", "&Oacute;", $string);
	$string = str_replace("�", "&oacute;", $string);
	$string = str_replace("�", "&Ocirc;", $string);
	$string = str_replace("�", "&ocirc;", $string);
	$string = str_replace("�", "&Ograve;", $string);
	$string = str_replace("�", "&ograve;", $string);
	$string = str_replace("�", "&Otilde;", $string);
	$string = str_replace("�", "&Otilde;", $string);
	$string = str_replace("�", "&Ouml;", $string);
	$string = str_replace("�", "&ouml;", $string);
	
	$string = str_replace("�", "&Uacute;", $string);
	$string = str_replace("�", "&uacute;", $string);
	$string = str_replace("�", "&Ucirc;", $string);
	$string = str_replace("�", "&ucirc;", $string);
	$string = str_replace("�", "&Ugrave;", $string);
	$string = str_replace("�", "&ugrave;", $string);
	$string = str_replace("�", "&Uuml;", $string);
	$string = str_replace("�", "&uuml;", $string);
	
	$string = str_replace("�", "&Ccedil;", $string);
	$string = str_replace("�", "&ccedil;", $string);
	$string = str_replace("�", "&Ntilde;", $string);
	$string = str_replace("�", "&ntilde;", $string);
	$string = str_replace("�", "&Yacute;", $string);
	$string = str_replace("�", "&yacute;", $string);
    }
    
    //Transforma o entities do html para caracter especial
    public static function getEntitiesParaEspecialCaracter($string)
    {
        //faz  tratamento dos caracteres especiais 
	$string = str_replace("&Aacute;", "�", $string);
	$string = str_replace("&aacute;", "�",  $string);
	$string = str_replace("&Acirc;", "�",  $string);
	$string = str_replace("&acirc;", "�",  $string);
	$string = str_replace("&Agrave;", "�",  $string);
	$string = str_replace("&agrave;", "�",  $string);
	$string = str_replace("&Aring;", "�",  $string);
	$string = str_replace("&aring;", "�",$string);
	$string = str_replace("&Atilde;", "�",  $string);
	$string = str_replace("&atilde;", "�", $string);
	$string = str_replace("&auml;", "�", $string);
	
	$string = str_replace("&Eacute;", "�",  $string);
	$string = str_replace("&eacute;", "�",  $string);
	$string = str_replace("&Ecirc;", "�",  $string);
	$string = str_replace("&ecirc;", "�", $string);
	$string = str_replace("&Egrave;", "�",  $string);
	$string = str_replace("&egrave;", "�",  $string);
	$string = str_replace("&Euml;", "�",  $string);
	$string = str_replace("&euml;", "�",  $string);
	
	$string = str_replace("&Iacute;", "�",  $string);
	$string = str_replace("&iacute;", "�",  $string);
	$string = str_replace("&Icirc;", "�",  $string);
	$string = str_replace("&icirc;", "�",  $string);
	$string = str_replace("&Igrave;", "�",  $string);
	$string = str_replace("&igrave;", "�",  $string);
	$string = str_replace("&Iuml;", "�",  $string);
	$string = str_replace("&iuml;", "�",  $string);
	
	$string = str_replace("&Oacute;", "�",  $string);
	$string = str_replace("&oacute;", "�",  $string);
	$string = str_replace("&Ocirc;", "�",  $string);
	$string = str_replace("&ocirc;", "�", $string);
	$string = str_replace("&Ograve;", "�",  $string);
	$string = str_replace("&ograve;", "�",  $string);
	$string = str_replace("&Otilde;", "�",  $string);
	$string = str_replace("&Otilde;", "�",  $string);
	$string = str_replace("&Ouml;", "�",  $string);
	$string = str_replace("&ouml;", "�",  $string);
	
	$string = str_replace("&Uacute;", "�",  $string);
	$string = str_replace("&uacute;", "�",  $string);
	$string = str_replace("&Ucirc;", "�", $string);
	$string = str_replace("&ucirc;", "�", $string);
	$string = str_replace("&Ugrave;", "�", $string);
	$string = str_replace("&ugrave;", "�", $string);
	$string = str_replace("&Uuml;", "�", $string);
	$string = str_replace("&uuml;", "�", $string);
	
	$string = str_replace("&Ccedil;", "�", $string);
	$string = str_replace("&ccedil;", "�",  $string);
	$string = str_replace("&Ntilde;", "�",  $string);
	$string = str_replace("&ntilde;", "�",  $string);
	$string = str_replace("&Yacute;", "�",  $string);
	$string = str_replace("&yacute;", "�",  $string);
    }
}

?>
