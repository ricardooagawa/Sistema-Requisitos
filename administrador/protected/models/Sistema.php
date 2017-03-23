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
            $string = str_replace("Á", "A", $string);
            $string = str_replace("á", "a", $string);
            $string = str_replace("Â", "A", $string);
            $string = str_replace("â", "a", $string);
            $string = str_replace("À", "A", $string);
            $string = str_replace("à", "a", $string);
            $string = str_replace("Å", "A", $string);
            $string = str_replace("å", "a", $string);
            $string = str_replace("Ã", "A", $string);
            $string = str_replace("ã", "a", $string);
            $string = str_replace("ä", "a", $string);

            $string = str_replace("É", "E", $string);
            $string = str_replace("é", "e", $string);
            $string = str_replace("Ê", "E", $string);
            $string = str_replace("ê", "e", $string);
            $string = str_replace("È", "E", $string);
            $string = str_replace("è", "e", $string);
            $string = str_replace("Ë", "E", $string);
            $string = str_replace("ë", "e", $string);

            $string = str_replace("Í", "I", $string);
            $string = str_replace("í", "i", $string);
            $string = str_replace("Î", "I", $string);
            $string = str_replace("î", "i", $string);
            $string = str_replace("Ì", "I", $string);
            $string = str_replace("ì", "i", $string);
            $string = str_replace("Ï", "I", $string);
            $string = str_replace("ï", "i", $string);

            $string = str_replace("Ó", "O", $string);
            $string = str_replace("ó", "o", $string);
            $string = str_replace("Ô", "O", $string);
            $string = str_replace("ô", "o", $string);
            $string = str_replace("Ò", "O", $string);
            $string = str_replace("ò", "o", $string);
            $string = str_replace("Õ", "O", $string);
            $string = str_replace("õ", "o", $string);
            $string = str_replace("Ö", "O", $string);
            $string = str_replace("ö", "o", $string);

            $string = str_replace("Ú", "U", $string);
            $string = str_replace("ú", "u", $string);
            $string = str_replace("Û", "U", $string);
            $string = str_replace("û", "u", $string);
            $string = str_replace("Ù", "U", $string);
            $string = str_replace("ù", "u", $string);
            $string = str_replace("Ü", "U", $string);
            $string = str_replace("ü", "u", $string);

            $string = str_replace("Ç", "C", $string);
            $string = str_replace("ç", "c", $string);
            $string = str_replace("Ñ", "N", $string);
            $string = str_replace("ñ", "n", $string);
            $string = str_replace("Ý", "Y", $string);
            $string = str_replace("ý", "y", $string);
            
            return $string;
        }
    }
    
    //Transforma o caracter especial para entities do html
    public static function getEspecialCaracterParaEntities($string)
    {
        //faz  tratamento dos caracteres especiais 
	$string = str_replace("Á", "&Aacute;", $string);
	$string = str_replace("á", "&aacute;", $string);
	$string = str_replace("Â", "&Acirc;", $string);
	$string = str_replace("â", "&acirc;", $string);
	$string = str_replace("À", "&Agrave;", $string);
	$string = str_replace("à", "&agrave;", $string);
	$string = str_replace("Å", "&Aring;", $string);
	$string = str_replace("å", "&aring;", $string);
	$string = str_replace("Ã", "&Atilde;", $string);
	$string = str_replace("ã", "&atilde;", $string);
	$string = str_replace("ä", "&auml;", $string);
	
	$string = str_replace("É", "&Eacute;", $string);
	$string = str_replace("é", "&eacute;", $string);
	$string = str_replace("Ê", "&Ecirc;", $string);
	$string = str_replace("ê", "&ecirc;", $string);
	$string = str_replace("È", "&Egrave;", $string);
	$string = str_replace("è", "&egrave;", $string);
	$string = str_replace("Ë", "&Euml;", $string);
	$string = str_replace("ë", "&euml;", $string);
	
	$string = str_replace("Í", "&Iacute;", $string);
	$string = str_replace("í", "&iacute;", $string);
	$string = str_replace("Î", "&Icirc;", $string);
	$string = str_replace("î", "&icirc;", $string);
	$string = str_replace("Ì", "&Igrave;", $string);
	$string = str_replace("ì", "&igrave;", $string);
	$string = str_replace("Ï", "&Iuml;", $string);
	$string = str_replace("ï", "&iuml;", $string);
	
	$string = str_replace("Ó", "&Oacute;", $string);
	$string = str_replace("ó", "&oacute;", $string);
	$string = str_replace("Ô", "&Ocirc;", $string);
	$string = str_replace("ô", "&ocirc;", $string);
	$string = str_replace("Ò", "&Ograve;", $string);
	$string = str_replace("ò", "&ograve;", $string);
	$string = str_replace("Õ", "&Otilde;", $string);
	$string = str_replace("õ", "&Otilde;", $string);
	$string = str_replace("Ö", "&Ouml;", $string);
	$string = str_replace("ö", "&ouml;", $string);
	
	$string = str_replace("Ú", "&Uacute;", $string);
	$string = str_replace("ú", "&uacute;", $string);
	$string = str_replace("Û", "&Ucirc;", $string);
	$string = str_replace("û", "&ucirc;", $string);
	$string = str_replace("Ù", "&Ugrave;", $string);
	$string = str_replace("ù", "&ugrave;", $string);
	$string = str_replace("Ü", "&Uuml;", $string);
	$string = str_replace("ü", "&uuml;", $string);
	
	$string = str_replace("Ç", "&Ccedil;", $string);
	$string = str_replace("ç", "&ccedil;", $string);
	$string = str_replace("Ñ", "&Ntilde;", $string);
	$string = str_replace("ñ", "&ntilde;", $string);
	$string = str_replace("Ý", "&Yacute;", $string);
	$string = str_replace("ý", "&yacute;", $string);
    }
    
    //Transforma o entities do html para caracter especial
    public static function getEntitiesParaEspecialCaracter($string)
    {
        //faz  tratamento dos caracteres especiais 
	$string = str_replace("&Aacute;", "Á", $string);
	$string = str_replace("&aacute;", "á",  $string);
	$string = str_replace("&Acirc;", "Â",  $string);
	$string = str_replace("&acirc;", "â",  $string);
	$string = str_replace("&Agrave;", "À",  $string);
	$string = str_replace("&agrave;", "à",  $string);
	$string = str_replace("&Aring;", "Å",  $string);
	$string = str_replace("&aring;", "å",$string);
	$string = str_replace("&Atilde;", "Ã",  $string);
	$string = str_replace("&atilde;", "ã", $string);
	$string = str_replace("&auml;", "ä", $string);
	
	$string = str_replace("&Eacute;", "É",  $string);
	$string = str_replace("&eacute;", "é",  $string);
	$string = str_replace("&Ecirc;", "Ê",  $string);
	$string = str_replace("&ecirc;", "ê", $string);
	$string = str_replace("&Egrave;", "È",  $string);
	$string = str_replace("&egrave;", "è",  $string);
	$string = str_replace("&Euml;", "Ë",  $string);
	$string = str_replace("&euml;", "ë",  $string);
	
	$string = str_replace("&Iacute;", "Í",  $string);
	$string = str_replace("&iacute;", "í",  $string);
	$string = str_replace("&Icirc;", "Î",  $string);
	$string = str_replace("&icirc;", "î",  $string);
	$string = str_replace("&Igrave;", "Ì",  $string);
	$string = str_replace("&igrave;", "ì",  $string);
	$string = str_replace("&Iuml;", "Ï",  $string);
	$string = str_replace("&iuml;", "ï",  $string);
	
	$string = str_replace("&Oacute;", "Ó",  $string);
	$string = str_replace("&oacute;", "ó",  $string);
	$string = str_replace("&Ocirc;", "Ô",  $string);
	$string = str_replace("&ocirc;", "ô", $string);
	$string = str_replace("&Ograve;", "Ò",  $string);
	$string = str_replace("&ograve;", "ò",  $string);
	$string = str_replace("&Otilde;", "Õ",  $string);
	$string = str_replace("&Otilde;", "õ",  $string);
	$string = str_replace("&Ouml;", "Ö",  $string);
	$string = str_replace("&ouml;", "ö",  $string);
	
	$string = str_replace("&Uacute;", "Ú",  $string);
	$string = str_replace("&uacute;", "ú",  $string);
	$string = str_replace("&Ucirc;", "Û", $string);
	$string = str_replace("&ucirc;", "û", $string);
	$string = str_replace("&Ugrave;", "Ù", $string);
	$string = str_replace("&ugrave;", "ù", $string);
	$string = str_replace("&Uuml;", "Ü", $string);
	$string = str_replace("&uuml;", "ü", $string);
	
	$string = str_replace("&Ccedil;", "Ç", $string);
	$string = str_replace("&ccedil;", "ç",  $string);
	$string = str_replace("&Ntilde;", "Ñ",  $string);
	$string = str_replace("&ntilde;", "ñ",  $string);
	$string = str_replace("&Yacute;", "Ý",  $string);
	$string = str_replace("&yacute;", "ý",  $string);
    }
}

?>
