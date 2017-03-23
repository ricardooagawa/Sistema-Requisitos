<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'usuarios'), 
                Yii::t('breadcrumbs', 'buscar_usuarios')
            ),
        )
);
?>

<div class="wide form">

<p class="titulo"><?php echo "Busca de Usuário";?></p>

<br>

<?php
$form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'buscar-usuario',
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
        'htmlOptions' => array('class' => 'well'),
    )
); ?>

	<div class="row">
		<?php echo $form->label($model,'nom_usuario'); ?>
		<?php echo $form->textField($model,'nom_usuario',array('style'=>'width: 50%;', 'maxlength'=>80, 'class' =>'col-sm-5, form-control', 'placeholder'=>'Usuário')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_perfil'); ?>
		<?php
			$perfil= $model->cod_perfil;
			$perfis = CHtml::listData(CadPerfil::model()->findAll(array('order'=>'des_perfil asc')), 'cod_perfil', 'des_perfil');
			echo $form->DropDownList($model, 'cod_perfil', $perfis, array(
				'prompt'=>'Todos',
				'options'=>array($perfil=>array('selected'=>true)),
				'class' => 'form-control',
				'style'=>'width: 20%;',
				)
			);
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'cod_projeto'); ?>
		<?php echo $form->dropDownList($model,'cod_projeto',
                            CHtml::listData(CadProjeto::model()->findAll(array('order'=>'des_projeto', 'condition'=>'flg_ativo="S"')), 'cod_projeto', 'des_projeto'),
                            array(
                                    'empty'=>'Todos',
                                    'style'=>'width:30%',
                                    'class' => 'col-sm-5, form-control')
                        );
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'flg_ativo'); ?>
		<?php echo $form->checkBox($model,'flg_ativo',$options); ?> 
	</div>
	
	<div class="row">		
		<!-------------------- Botão novo registro ------------------------------->
		<?php 
		if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'I'))
		{
			$this->widget('booster.widgets.TbButton', array(
									'buttonType' => 'button',
									'label' => 'Novo Registro', 
									'context' => 'info',
									'htmlOptions'=>array(
										'submit'=>Yii::app()->createUrl('Usuario/Incluir'),
										'onClick'=>'js:Voltar();', 
										'class'=>'btn-right'
										),
									));
		}
		?>
	
		<!-------------------- Botão Buscar ------------------------------->
		<?php 
		if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'L'))
		{	
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'buttonType' => 'submit', 
					'label' => 'Buscar',
					'context' => 'primary',
					'htmlOptions' => array(
						'submit'=>Yii::app()->createUrl('Usuario/Buscar'),
					),
				)
			);
		}
		?>
	</div>
	<?php $this->endWidget(); ?>
</div>