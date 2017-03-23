<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'perfil'), 
                Yii::t('breadcrumbs', 'incluir_perfil')
            ),
        )
);
?>

<p class="titulo"><?php echo "Cadastro de Perfil";?></p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>