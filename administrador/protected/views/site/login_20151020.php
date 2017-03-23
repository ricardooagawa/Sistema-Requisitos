<!-- Autenticação do usuário -->
<style>
#content
{
	padding: 0 !important; 
}

.btn-login
{
	border-radius: 100%; 
	width: 140px; 
	height: 140px; 
	border: 10px white solid; 
	position: relative; 
	top: 50px;
}

.btn-login:hover
{
	border-radius: 100%; 
	width: 140px; 
	height: 140px; 
	border: 10px #CD3333 solid; 
	background: #CD5C5C;
	position: relative; 
	top: 50px;
}

label
{
	visibility: hidden;
}
</style>
<div style="position: relative; top: -100px;">
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
);
?>

<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'login-form',
		'type' => 'horizontal',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>false,
		),
		'enableAjaxValidation'=>false,
	)
); ?>
	
	<div align="center">
		<img style="width:auto; height:10%; margin: 10px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" />
	</div>
	
	<div class="login-bg">

		<div align="center" style="padding: 25px;">
			
			<div align='center'>
				<b align='center'>Autenticação</b><br>
				<p>Informe suas credenciais de acesso a aplicação</p>
			</div>
	
			<div style="width: 50%;">
				<div>
					<?php echo $form->textFieldGroup($model,'username', array('wrapperHtmlOptions' => array('class' => 'col-sm-6'), 'prepend' => '<i class="glyphicon glyphicon-user"></i>')); ?>
				</div>
			
				<div>
					<?php echo $form->passwordFieldGroup($model,'password', array('wrapperHtmlOptions' => array('class' => 'col-sm-6'), 'prepend' => '<i class="glyphicon glyphicon-lock"></i>')); ?>
				</div>
			
				<div> 	
					<?php if(CCaptcha::checkRequirements()): ?>
						<?php echo $form->textFieldGroup($model,'verifyCode', array('wrapperHtmlOptions' => array('class' => 'col-sm-6',))); ?>
						<br>
						<?php $this->widget('CCaptcha',array('imageOptions'=>array('style'=>'vertical-align:right; border-radius: 100%;'))); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="form-actions" align="center">
			<?php $this->widget(
				'booster.widgets.TbButton',
				array(
					'buttonType' => 'submit',
					'context' => 'primary',
					'label' => 'Acessar',
					'htmlOptions'=>array(
						'name'=>'btnAcessar',
						'class'=>'btn-login'
					),
				)	
				
			); 
			?>
		</div>
	</div>
<?php $this->endWidget(); ?>
</div>