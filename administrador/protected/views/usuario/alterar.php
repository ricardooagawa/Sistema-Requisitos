<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'usuarios'), 
                Yii::t('breadcrumbs', 'alterar_usuarios')
            ),
        )
);
?>

<p class="titulo" style="font-size: 14pt;"><?php echo "Altera��o de Usu�rio";?></p><br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>