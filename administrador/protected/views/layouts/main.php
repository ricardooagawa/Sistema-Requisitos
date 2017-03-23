<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html;">
        <meta name="language" content="pt-br">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
        <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png">


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>	
    </head>

    <body>


        <?php
        
        $user = CadUsuario::model()->findByPk(Yii::app()->user->id);
        
        if (!Yii::app()->user->isGuest) 
        {
            //Verifica se o usuário está logado para exibir informações
            $perfil = CadUsuario::model()->getPerfil($user['cod_perfil']);
            $projeto = CadUsuario::model()->getNomeProjeto();

            $info = "<div class='info-header'>
                        <div style='position: relative; top: -45px; left:190px; font-size:12px; text-align: right; width: 85%;'>
                            Usuário: <b>" . Yii::app()->user->name . "</b><br>
                            Perfil: <b>" . $perfil . "</b><br>
                            Projeto: <b>" . $projeto . "</b><br>
                        </div>
                    </div>";
        } 
        else 
        {
            $info = "";
        }
        ?>
        
        <div class="container" id="page">

        <?php
        //verifica se o usuario está logado ou não
        if (Yii::app()->user->isGuest)
        {
            $visivel = "style='visibility: hidden;'";
        }
        else 
        {
            $visivel = "style='visibility: visible;'";
        }
        ?>

            <div id="header" <?php echo $visivel; ?>>
            <?php
            $url = Yii::app()->createUrl('logo.png');
            $url = str_replace('index.php', 'images', $url);
            ?>
                <div id="logo" <?php echo $visivel; ?>>

                <?php echo CHtml::image($url, '', array('height' => '100px')); ?>
                    <span style="font-size: 12pt;">Sistema de Gerenciamento de Projetos</span>
                    <div id="info"><?php echo $info; ?></div>			

                </div>

                <div id="mainmenu">
                    <?php
                    //Configurações do menu superior principal
                    $this->widget(
                        'booster.widgets.TbNavbar', array(
                        'brand' => 'Início',
                        'fixed' => false,
                        'fluid' => true,
                            'items' => array(
                                array(
                                    'class' => 'booster.widgets.TbMenu',
                                    'type' => 'navbar',
                                    'items' => array(

                                        //Menu Configurações
                                        array(
                                            'label' => 'Configurações',
                                            'visible'=>(CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],1)
                                                        or CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],2)
                                                        or CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],3)),
                                            'items' => array(
                                                
                                                //Submenus de Configuração
                                                array('label' => 'Perfis de Acesso', 'url' => Yii::app()->baseUrl.'/index.php/Perfil/Buscar', 'visible'=>CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],1)),
                                                 array('label' => 'Projetos', 'url' => Yii::app()->baseUrl.'/index.php/Projeto/Buscar', 'visible'=>CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],3)),
                                                array('label' => 'Usuários', 'url' => Yii::app()->baseUrl.'/index.php/Usuario/Buscar', 'visible'=>CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],2)),
                                               
                                            )
                                        ),
                                        
                                        //Menu Cadastros
                                        array(
                                            'label' => 'Cadastros',
                                            'visible'=>CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],4),
                                            'items' => array(
                                                
                                                //Submenus de Cadastros
                                                array('label' => 'Requisitos', 'url' => Yii::app()->baseUrl.'/index.php/RespostaUsuario/Buscar', 'visible'=>CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($user['cod_perfil'],4)),
                                              
                                            )
                                        ),

                                         //Menu Sair
                                         array('label' => 'Sair','url' => Yii::app()->baseUrl.'/index.php/Site/Logout','linkOptions'=>array('confirm'=>'Deseja realmente sair?')),
                                    )
                                )
                            )
                        )
                    );
                    ?>
                </div><!-- mainmenu -->
            </div><!-- header -->	

            <!-- breadcrumbs -->
            <?php
            if (isset($this->breadcrumbs)) {
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
            }
            ?>
        </div>

        <?php echo $content; ?>
        
        <br><br>
        
        <div class="rodape" align="center" <?php echo $visivel; ?>>
            <div style="font-size: 8pt;">Sistema de Gerenciamento de Projetos<br> Ricardo Ogawa <br> - Versão 1.0 -</div>
        </div>
        
        <br>	
        
        <div class="clear"></div>

    </div><!-- page -->

</body>
</html>