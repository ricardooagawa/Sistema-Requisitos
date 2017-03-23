<div class="wide form">
<script language="javascript">

      function Voltar() {
            window.location='<?php echo Yii::app()->createUrl('Usuario/Buscar') ?>';
      }
      
</script>
<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'horizontalForm',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data'
		),
	)
); ?>

	<?php echo "<p class='note'>Campos com <span class='required'>*</span> são obrigatórios.</p>";?>
	
	<?php echo $form->errorSummary($model); ?>
	
	<fieldset>
	<legend><font size='3pt'><b> Informações pessoais</b></font></legend>
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'nom_usuario'); ?>
			<?php echo $form->textField($model,'nom_usuario', array('style'=>'width: 40%;', 'maxlength'=>255, 'class' =>'col-sm-5, form-control', 'placeholder'=>'Usuário')); ?>
		</div>
		
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'cod_perfil'); ?>
			<?php echo $form->dropDownList($model,'cod_perfil',
                                CHtml::listData(CadPerfil::model()->findAll(array('order'=>'des_perfil')), 'cod_perfil', 'des_perfil'),
                                array(
                                        'empty'=>'Selecione',
                                        'style'=>'width:30%',
                                        'class' => 'col-sm-5, form-control')
                                );
			?>
		</div>
		
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'cod_projeto'); ?>
			<?php echo $form->dropDownList($model,'cod_projeto',
                                    CHtml::listData(CadProjeto::model()->findAll(array('order'=>'des_projeto', 'condition'=>'flg_ativo="S"')), 'cod_projeto', 'des_projeto'),
                                    array(
                                            'empty'=>'Todos',
                                            'style'=>'width:30%',
                                            'class' => 'col-sm-5, form-control')
                                    );
			?>
		</div>
				
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'des_email'); ?>
			<?php echo $form->textField($model,'des_email',array('style'=>'width: 40%;', 'maxlength'=>255, 'class' =>'col-sm-5, form-control', 'placeholder'=>'Email')); ?>
		</div>
	</fieldset>
	
	<fieldset>
	<legend><font size='3pt'><b> Acesso</b></font></legend>
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'des_login'); ?>
			<?php echo $form->textField($model,'des_login',array('style'=>'width: 40%;', 'maxlength'=>20, 'class' =>'col-sm-5, form-control', 'placeholder'=>'Login')); ?>
		</div>
	
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'des_senha'); ?>
			<?php echo $form->passwordField($model,'des_senha',array('style'=>'width: 20%;', 'maxlength'=>50, 'class' => 'col-sm-5, form-control ', 'placeholder'=>'Senha')); ?>
		</div>
		
		<div class="row" id="form">
			<?php echo $form->labelEx($model,'flg_ativo'); ?>
			<?php 
				if($model->flg_ativo!='N')
					$options=array('value'=>'S', 'uncheckValue'=>'N', 'checked'=>'true');
				else
					$options=array('value'=>'S', 'uncheckValue'=>'N');
			echo $form->checkBox($model,'flg_ativo',$options); ?>
			<?php echo $form->error($model,'flg_ativo'); ?>
		</div>
	</fieldset>
	
	<div style="float: left;">	
		<?php $this->widget('booster.widgets.TbButton', array(
								'buttonType' => 'submit',
								'context' => $model->isNewRecord ? 'primary' : 'success',
								'label' => $model->isNewRecord ? 'Salvar' : 'Alterar',
								'htmlOptions'=>array(
									'name'=>'btnClick',
									),
								));
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

<?php $this->endWidget(); ?>

</div><!-- form -->