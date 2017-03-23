<?php $this->renderPartial('_buscar',array('model'=>$model,'options'=>$options)); ?>

<?php
if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'L'))
{	
	$this->widget(
		'booster.widgets.TbExtendedGridView',
		array(
			'fixedHeader' => false,
			'type' => 'striped bordered',
			'responsiveTable' => true,
			'id'=>'usuario-grid',
			'dataProvider'=>$model->search(),
			'template' => "{summary}\n{items}\n{pager}",
			'columns'=>array(
		
				array('name' =>'nom_usuario','htmlOptions'=>array('width'=>'180px')),
				
				array(
                                    'name' => 'cod_perfil',
                                    'value'=>'CadUsuario::model()->getPerfil($data["cod_perfil"])',
                                    'htmlOptions'=>array('width'=>'230px')
                                ),
                            
                                array(
                                    'name' => 'cod_projeto',
                                    'value'=>'CadProjeto::model()->getProjeto($data["cod_projeto"])',
                                    'htmlOptions'=>array('width'=>'320px')
				),
							                            
                                array(
                                    'name' => 'des_email',
                                    'value'=>'$data->des_email',
                                    'htmlOptions'=>array('width'=>'180px')
				),
						
                                array(
                                    'name' => 'dat_cadastro',
                                    'value'=>'Sistema::getExibeData($data["dat_cadastro"])',
                                    'htmlOptions'=>array('width'=>'100px')
				),
                            
				array('name'=>'flg_ativo','htmlOptions'=>array('width'=>'30px'), 'value'=>'($data["flg_ativo"]=="S")?"Sim":"Não"'),
						
				array(
					'header' => 'Ação',
					'class' => 'booster.widgets.TbButtonColumn',
					'htmlOptions'=>array('style'=>'width: 80px;'),
					'template'=>'{view}{update}{delete}',
					
					'buttons'=>array(
						'view'=>array(
							'url'=>'Yii::app()->createUrl("/Usuario/Visualizar", array("codigo"=>$data["cod_usuario"]))',
							'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"V")',
						),
						'update'=>array(
							'url'=>'Yii::app()->createUrl("/Usuario/Alterar", array("codigo"=>$data["cod_usuario"]))',
							'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"A")',
						),
						'delete'=>array(
							'url'=>'Yii::app()->createUrl("/Usuario/Excluir", array("codigo"=>$data["cod_usuario"]))',
							'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"E")',
						),
					),
				),
			
				array(
					'class'=>'EDedoDuro', 
					'name' => '', 
					'icon' => 'images/dedoduro.png', 
					'pre_alt' => 'última alteração em', 
					'alt' => 'dat_atualizacao', 
					'fun_alt' => 'por', 
					'pos_alt' => 'cod_id_usuario', 
					'htmlOptions' => array('style' => 'width: 16px;'),
				),
			),
		)
	);
}
?>
