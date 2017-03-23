<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'perfil'), 
                Yii::t('breadcrumbs', 'alterar_perfil')
            ),
        )
);
?>

<p class="titulo"><?php echo "Alteração de Perfil";?></p><br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>