<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'projeto'), 
                Yii::t('breadcrumbs', 'incluir_projeto')
            ),
        )
);
?>

<p class="titulo"><?php echo "Cadastro de Projeto";?></p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>