<div class="wide form">
<script language="javascript">

    function Voltar() 
	{
        window.location='<?php echo Yii::app()->createUrl('Perfil/Buscar') ?>';
    }
	  
	// Função para selecionar todos os checkbox 
	function seleciona()
	{
		if(document.getElementById('chkSeleciona').checked==true)
		{
			for (i=0;i<document.getElementsByTagName('input').length;i++)
				if(document.getElementsByTagName('input')[i].type == "checkbox")
					document.getElementsByTagName('input')[i].checked=true
		}
		if(document.getElementById('chkSeleciona').checked==false)
		{
			for (i=0;i<document.getElementsByTagName('input').length;i++)
			{
				if(document.getElementsByTagName('input')[i].type == "checkbox")
					document.getElementsByTagName('input')[i].checked=false
			}
		}
	}
</script>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'perfil-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo "<p class='note'>Campos com <span class='required'>*</span> são obrigatórios.</p>";?><br>

	<?php echo $form->errorSummary($model); ?>
	
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
	<fieldset>
	<div class="row">
		<?php echo $form->labelEx($model, 'des_perfil');?>
		<?php echo $form->textField($model,'des_perfil',array('style'=>'width: 30%;', 'maxlenght'=>80, 'class' =>'col-sm-5, form-control'));?>
		<?php echo $form->error($model,'des_perfil');?>
	</div>
		
	<div class="row">
		<?php echo $form->checkbox($model,'chkSeleciona', array('name'=>'chkSeleciona', 'id'=>'chkSeleciona', 'onClick'=>'JavaScript: seleciona();')); ?>	
		<?php echo $form->label($model,'chkSeleciona',array('label'=>'Selecionar todos')); ?>
	</div>

	<?php
	$funcionalidades=BasFuncionalidade::model()->findAllBySql('SELECT * FROM tb_bas_funcionalidade ORDER BY des_funcionalidade ASC');
	$contador=0;
	if(!empty($funcionalidades))
	{
		foreach($funcionalidades as $cont=>$registro)
		{
			if($registro['flg_ativo']!='N')
			{
				echo "<div class='row' style='margin-left:2.5%;'><br><b>".$registro['des_funcionalidade']."</b></div>";
				$permissao=BasFuncionalidadeAcao::model()->findAllBySql("select * from tb_bas_funcionalidade_acao where cod_funcionalidade=".$registro['cod_funcionalidade']." order by cod_funcionalidade, cod_acao asc");
				if(!empty($permissao))
				{
					foreach($permissao as $chave=>$acao)
					{
						echo "<div class='row'>";
						if($model->cod_perfil!='')
						{
							$perfilfuncionalidade=CadPerfilFuncionalidade::model()->findBySql("select * from tb_cad_perfil_funcionalidade where cod_perfil=".$model->cod_perfil." and cod_funcionalidade_acao='".$acao->cod_funcionalidade_acao ."'");
							if(isset($perfilfuncionalidade))
							{
								//Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
								$options=array('value'=>'1', 'uncheckValue'=>'0', 'checked'=>'true','id'=>'cod_acao'.$acao->cod_funcionalidade_acao,'name'=>'cod_acao'.$acao->cod_funcionalidade_acao);
							}
							else
							{
								//Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
								$options=array('value'=>'1', 'uncheckValue'=>'0', 'id'=>'cod_acao'.$acao->cod_funcionalidade_acao,'name'=>'cod_acao'.$acao->cod_funcionalidade_acao);
							}
						}
						else
						{
							//Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
							$options=array('value'=>'1', 'uncheckValue'=>'0', 'checked'=>'true','id'=>'cod_acao'.$acao->cod_funcionalidade_acao,'name'=>'cod_acao'.$acao->cod_funcionalidade_acao);
						}
						echo $form->checkbox($acao,'cod_acao', $options).' ';	
						echo $form->label($acao,'cod_acao',array('label'=>$acao->getAcaoNome($acao->cod_acao)));
						echo "</div>";
					}
				}
			}
			$contador++;
		}
	}
	?>
</fieldset>

<!---------------------------modal (buscar)--------------------------------->
<?php $this->beginWidget(
	'booster.widgets.TbModal',
	array('id' => 'myModal')
); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Perfil de acesso - Incluir</h4>
	</div>
 
	<div class="modal-body">
		<p>Tem certeza que deseja salvar esse perfil?</p>
	</div>
 
	<div class="modal-footer">
		 <?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit', 
			'context' => 'primary',
			'label'=>'Salvar',
			'url'=>'#',
			'htmlOptions'=>array('name'=>'btnClick'),
		)); 
		?>
		
		<?php $this->widget('booster.widgets.TbButton', array(
				'label' => 'Não',
				'url' => '#',
				'htmlOptions' => array('data-dismiss' => 'modal'),
			)
		); 
		?>
	</div>
 
<?php $this->endWidget(); ?>
<br><br><br>

	<!-- botao (bootstrap) -->
	<div class="form-actions" style="position: relative; bottom: 50px;">
		
		<?php $this->widget('booster.widgets.TbButton',
				array(
					'label' => 'Salvar',
					'buttonType'=>'Submit', 
					'context' => 'primary',
					'htmlOptions' => array(
						'data-toggle' => 'modal',
						'data-target' => '#myModal',
					),
				)
			);
		?>
		
		<?php 
		$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'button', 
			'label'=>'Voltar', 
			'context' => 'info',
			'htmlOptions'=>array(
				'onClick'=>'js:Voltar();', 
				'class'=>'btn-right'
			),
		)); 
		?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->