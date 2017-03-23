<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs',
   	array(
		'links' => array(Yii::t('breadcrumbs','configuracoes'), 
		Yii::t('breadcrumbs','parametros')),
    )
);
?>

<div class="wide form">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'parametro-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="titulo" style="font-size: 14pt;"><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ico_parametros.png'><?php echo "Parâmetros do Sistema";?></p><br>

<?php 
	//Chamada de Salvo com sucesso 
	$this->widget('booster.widgets.TbAlert', array(
		'fade'=>true,
		'closeText'=>'&times;', 
		'alerts'=>array( 
			'success'=>array('block'=>true, 'fade'=>false, 'closeText'=>'&times;'), // success, info, warning, error or danger
		),
	));
?>


<fieldset>
	<legend><font size='3pt'><b>Configurações de E-mail</b></font></legend>
	<?php		
		//Parametros
		$parametro=CadParametro::model()->findAllBySQL('select * from tb_cad_parametro order by val_ordem asc');
		$contador=0;
		foreach($parametro as $cont=>$registro)
		{
			if($contador<=5)
			{
				$model->cod_parametro=$registro['cod_parametro'];
				$model->des_parametro=$registro['des_parametro'];
				$model->des_sigla=$registro['des_sigla'];
				$model->val_parametro=$registro['val_parametro'];
				$model->cod_usuario=1;
				$model->dat_atualizacao=$registro['dat_atualizacao'];
				echo "<div class='row' id='form' style='height:40px;'>";
					echo $form->label($model,'des_parametro',array('label'=>$model->des_parametro));
					echo CHtml::textField('val_parametro'.$registro['cod_parametro'],$model->val_parametro,array('id'=>'val_parametro'.$contador,'name'=>'val_parametro'.$contador,'size'=>'50', 'maxlength'=>'4000', 'class'=>'form-control', 'style'=>'width: 60%;', ));
				echo "</div>";
				
				$contador++;
			}
		}
		
		echo "<br>";
	?>
</fieldset>

<fieldset>
	<legend><font size='3pt'><b>Configurações de SMS</b></font></legend>
	<?php		
		//Parametros
		$parametro=CadParametro::model()->findAllBySQL("select * from tb_cad_parametro where des_sigla in ('SMS', 'SSM') order by val_ordem asc");
		$contador=0;
		foreach($parametro as $cont=>$registro)
		{
			if($contador<=2)
			{
				$model->cod_parametro=$registro['cod_parametro'];
				$model->des_parametro=$registro['des_parametro'];
				$model->des_sigla=$registro['des_sigla'];
				$model->val_parametro=$registro['val_parametro'];
				$model->cod_usuario=1;
				$model->dat_atualizacao=$registro['dat_atualizacao'];
				echo "<div class='row' id='form' style='height:40px;'>";
					echo $form->label($model,'des_parametro',array('label'=>$model->des_parametro));
					echo CHtml::textField('val_parametro'.$registro['cod_parametro'],$model->val_parametro,array('id'=>'val_parametro'.$contador,'name'=>'val_parametro'.$contador,'size'=>'50', 'maxlength'=>'4000', 'class'=>'form-control', 'style'=>'width: 60%;', ));
				echo "</div>";
			}
			
			$contador++;
		}
		
		echo "<br>";
	?>
</fieldset>

<fieldset>
	<legend><font size='3pt'><b>Configurações de Relatório</b></font></legend>
	<?php		
		//Parametros
		$parametro=CadParametro::model()->findAllBySQL("select * from tb_cad_parametro where des_sigla in ('URS') order by val_ordem asc");
		$contador=0;
		foreach($parametro as $cont=>$registro)
		{
			if($contador<=2)
			{
				$model->cod_parametro=$registro['cod_parametro'];
				$model->des_parametro=$registro['des_parametro'];
				$model->des_sigla=$registro['des_sigla'];
				$model->val_parametro=$registro['val_parametro'];
				$model->cod_usuario=1;
				$model->dat_atualizacao=$registro['dat_atualizacao'];
				echo "<div class='row' id='form' style='height:40px;'>";
					echo $form->label($model,'des_parametro',array('label'=>$model->des_parametro));
					echo CHtml::textField('val_parametro'.$registro['cod_parametro'],$model->val_parametro,array('id'=>'val_parametro'.$contador,'name'=>'val_parametro'.$contador,'size'=>'50', 'maxlength'=>'4000', 'class'=>'form-control', 'style'=>'width: 60%;', ));
				echo "</div>";
			}
			
			$contador++;
		}
		
		echo "<br>";
	?>
</fieldset>

<br><br>

<!-- mensagem para salvar -->
<?php $this->beginWidget('booster.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Salvar Parâmetros</h4>
</div>
 
<div class="modal-body">
    <p>Tem certeza que deseja Salvar ?</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit', 
        'label'=>'Salvar',
        'url'=>'#',
        'htmlOptions'=>array('name'=>'btnClick'),
    )); ?>
    <?php $this->widget('booster.widgets.TbButton', array(
        'label'=>'Fechar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
<!-- *******************  -->

<!-- botao (bootstrap) -->
<div class="form-actions" style="position: relative; bottom: 10px;">
	<?php 
	if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'A'))
	{	
		$this->widget('booster.widgets.TbButton', array(
			'label'=>'Salvar',
			'htmlOptions'=>array(
				'data-toggle'=>'modal',
				'data-target'=>'#myModal',
				'class'=>'btn_left',
			),
			));
	}
	?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->