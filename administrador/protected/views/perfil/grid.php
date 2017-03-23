<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('perfil-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->renderPartial('_buscar',array('model'=>$model)); ?>
<?php
if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'L'))
{
	$this->widget(
		'booster.widgets.TbExtendedGridView',
		array(
			'fixedHeader' => false,
			'type' => 'striped bordered',
			'responsiveTable' => true,
			'dataProvider'=>$model->search(),
			'template' => "{summary}\n{items}\n{pager}",
			'id'=>'perfil-grid',
			'columns'=>array(
	
			array('name' =>'des_perfil','htmlOptions'=>array('width'=>'600px', )),
			array(
				'header' => 'Ação',
				'class' => 'booster.widgets.TbButtonColumn',
				'template'=>'{view}{update}{delete}',
				
				'buttons'=>array(
					'update'=>array(
						'url'=>'Yii::app()->createUrl("/Perfil/Alterar", array("codigo"=>$data["cod_perfil"]))',
						'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"A")',
					),
					'delete'=>array(
						'url'=>'Yii::app()->createUrl("/Perfil/Excluir", array("codigo"=>$data["cod_perfil"]))',
						'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"E")',
					),
					'view'=>array(
						'url'=>'Yii::app()->createUrl("/Perfil/Visualizar", array("codigo"=>$data["cod_perfil"]))',
						'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"V")',
					),
				),
			),
			
			array(
				'class'=>'EDedoDuro', 
				'name' => '', 
				'icon' => 'images/dedoduro.png', 
				'pre_alt' => 'Última alteração em', 
				'alt' => 'dat_atualizacao', 
				'fun_alt' => 'por', 
				'pos_alt' => 'cod_usuario', 
				'htmlOptions' => array('style' => 'width: 16px;'),
			),
		),
		)
	);
}
?>
