<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'usuarios'), 
                Yii::t('breadcrumbs', 'visualizar_usuarios')
            ),
        )
);
?>

<script language="javascript">

      function Voltar() {
            window.location='<?php echo Yii::app()->createUrl('Usuario/Buscar') ?>';
      }
      
</script>

<p class="titulo"><?php echo "Visualização de Usuário";?></p>

<?php
	//Exibe a mensagem
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', 
		'events' => array(),
		'htmlOptions' => array(),
		'userComponentId' => 'user',
		'alerts' => array( 
		  'success' => array('closeText' => '&times;'),
		),
	));
?>

<div>
	<?php
	$this->widget(
		'booster.widgets.TbDetailView',
		array(
			'data' => $model,
			'attributes'=>array(
				'nom_usuario',		
				array('name'=>'cod_perfil','type'=>'raw','value'=>$model->getPerfil($model->cod_perfil)),
				array('name'=>'dat_cadastro','type'=>'raw','value'=>Sistema::getExibeData($model->dat_cadastro)),
				array('name'=>'des_email','type'=>'raw','value'=>$model->des_email),
				array('name'=>'cod_projeto','type'=>'raw','value'=>CadProjeto::model()->getProjeto($model->cod_projeto)),
				array('name'=>'flg_ativo','type'=>'raw','value'=>($model->flg_ativo=="S")?"Sim":"Não"),
			),
		)
	);
	?>
</div>
<div style="float: right;">	
	<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType' => 'button',
							'label' => 'Voltar', 
							'context' => 'info',
							'htmlOptions'=>array(
								'onClick'=>'js:Voltar();', 
								),
							));
	?>
</div>
