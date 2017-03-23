<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'perfil'), 
                Yii::t('breadcrumbs', 'buscar_perfil')
            ),
        )
);
?>
<div class="wide form">
    <p class="titulo"><?php echo "Busca de Perfis de Acesso"; ?></p>
    <br>

    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
            'id' => 'buscar-perfil',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'well'), // for inset effect
            )
    );
    ?>


    <!-------------------- Botão novo registro ------------------------------->
    <div style="margin-bottom: 10px;">
        <?php
        if (CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade, 'I')) {
            $this->widget('booster.widgets.TbButton', array(
                'buttonType' => 'button',
                'label' => 'Novo Registro',
                'context' => 'info',
                'htmlOptions' => array(
                    'submit' => Yii::app()->createUrl('Perfil/Incluir'),
                    'onClick' => 'js:Voltar();',
                    'class' => 'btn-right'
                ),
            ));
        }
        ?>		
    </div>
    <br>	
<?php $this->endWidget(); ?>
</div>