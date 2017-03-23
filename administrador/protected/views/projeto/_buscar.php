<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'projeto'), 
                Yii::t('breadcrumbs', 'buscar_projeto')
            ),
        )
);
?>

<div class="wide form">

    <p class="titulo"><?php echo "Busca de Projetos"; ?></p>
    <br>

    <?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'buscar-unidade',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'well'), // for inset effect
            )
    );
    ?>

    <div class="row label-buscar" id="form">
        <?php echo $form->label($model, 'des_projeto'); ?>
        <?php echo $form->textField($model, 'des_projeto', array('style' => 'width:40%', 'class' => 'col-sm-5, form-control', 'placeholder' => 'Projeto')); ?>
    </div>

    <div class="row label-buscar" id="form">
        <?php echo $form->label($model, 'flg_ativo'); ?>
        <?php echo $form->checkBox($model, 'flg_ativo', $options); ?> 
    </div>

    <!-------------------------Botão Novo Registro------------------------->
    <div class="row">		
        <?php
        if (CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade, 'I')) 
        {
            $this->widget('booster.widgets.TbButton', array(
                'buttonType' => 'button',
                'label' => 'Novo Registro',
                'context' => 'info',
                'htmlOptions' => array(
                    'submit' => Yii::app()->createUrl('Projeto/Incluir'),
                    'onClick' => 'js:Voltar();',
                    'class' => 'btn-right'
                ),
                    )
            );
        }
        ?>


        <!-----------------Botão Buscar----------------->
        <?php
        if (CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade, 'L')) 
        {
            $this->widget('booster.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => 'Buscar',
                'context' => 'primary',
                'htmlOptions' => array(),
                )
            );
        }
        ?>
    </div>

 <?php $this->endWidget(); ?>

</div>