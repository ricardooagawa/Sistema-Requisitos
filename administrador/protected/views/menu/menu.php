<?php
if(!Yii::app()->user->isGuest)
{
    //Verifica se o usuário está logado
    $usuario=CadUsuario::model()->findByPk(Yii::app()->user->id);
    $perfil=CadUsuario::model()->getPerfil($usuario->cod_perfil);

    //Faz a verificação de quais permissões o usuario logado tem no sistema de acordo com o perfil de acesso que ele possui, deixando o icone do menu disponível ou não
    if(CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($usuario->cod_perfil,1))
    {
        $per= "visibility: inline";
    }
    else
    {
        $per= "display: none";
    }
    
    if(CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($usuario->cod_perfil,2))
    {
        $usu= "visibility: inline";
    }
    else
    {
        $usu= "display: none";
    }
    
    if(CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($usuario->cod_perfil,3))
    {
        $projeto= "visibility: inline";
    }
    else
    {
        $projeto= "display: none";
    }
    
    if(CadPerfilFuncionalidade::model()->getPerfilFuncionalidade($usuario->cod_perfil,4))
    {
        $requisitos= "visibility: inline";
    }
    else
    {
        $requisitos= "display: none";
    }
} 
?>
<div>
    <fieldset>
        <legend>Menu</legend>
        <div class="row">

            <div class="col-md-4" style="<?php echo $usu; ?>">
                <div align="center">
                    <div class="icone-menu">
                        <?php
                        $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ico_usuario.png', 'Usuário');
                        echo CHtml::link($image, array('/Usuario/Buscar'));
                        ?>
                    </div>
                    <p align="center">Usuário</p>
                </div>
            </div>

            <div class="col-md-4" style="<?php echo $per; ?>">
                <div align="center">
                    <div class="icone-menu">
                        <?php
                        $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ico_perfil.png', 'Perfil de Acesso');
                        echo CHtml::link($image, array('/Perfil/Buscar'));
                        ?>
                    </div>
                    <p align="center">Perfil de Acesso</p>
                </div>
            </div>
            
            <div class="col-md-4" style="<?php echo $projeto; ?>">
                <div align="center">
                    <div class="icone-menu">
                        <?php
                        $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ico_projeto.png', 'Projeto');
                        echo CHtml::link($image, array('/Projeto/Buscar'));
                        ?>
                    </div>
                    <p align="center">Projeto</p>
                </div>
            </div>
            
            <div class="col-md-4" style="<?php echo $requisitos; ?>">
                <div align="center">
                    <div class="icone-menu">
                        <?php
                        $image = CHtml::image(Yii::app()->request->baseUrl . '/images/ico_requisitos.png', 'Requisitos');
                        echo CHtml::link($image, array('/RespostaUsuario/Buscar'));
                        ?>
                    </div>
                    <p align="center">Requisitos</p>
                </div>
            </div>

            <div class="col-md-4">
                <div align="center">
                    <div class="icone-menu">
                            <?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/ico_sair.png', 'Sair');
                                      echo CHtml::link($image,array('/site/logout')); 
                            ?>
                    </div>
                    <p align="center">Sair</p>
                </div>
            </div>
            
        </div>
    </fieldset>
</div>
