<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'cadastros'),
                Yii::t('breadcrumbs', 'requisitos'), 
                Yii::t('breadcrumbs', 'buscar_requisitos')
            ),
        )
);
?>

<div class="wide form">

    <p class="titulo"><?php echo "Busca de Requisitos"; ?></p>
    <br>

    <?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget(
                'booster.widgets.TbActiveForm', array(
                'id' => 'buscar-questionario',
                'type' => 'horizontal',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'well'), // for inset effect
            )
    );
    ?>

    <div class="row label-buscar" id="form">
        <?php echo $form->label($model, 'des_assunto'); ?>
        <?php echo $form->textField($model, 'des_assunto', array('style' => 'width:40%', 'class' => 'col-sm-5, form-control', 'placeholder' => 'Requisitos')); ?>
    </div>

    <div class="row">		
        <!-----------------Botão Buscar----------------->
        <?php
        if (CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade, 'L')) {
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