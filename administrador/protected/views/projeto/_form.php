<div class="wide form">
    <script language="javascript">

        function Voltar() {
            window.location = '<?php echo Yii::app()->createUrl('Projeto/Buscar') ?>';
        }

    </script>
    <?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
            'id' => 'horizontalForm',
            'type' => 'horizontal',
            )
    );
    ?>

<?php echo $form->errorSummary($model); ?>

    <fieldset>
        <div class="row">
            <?php echo $form->labelEx($model, 'des_projeto'); ?>
            <?php echo $form->textField($model, 'des_projeto', array('style' => 'width:40%', 'class' => 'col-sm-5, form-control', 'placeholder' => 'Projeto')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'flg_ativo'); ?>
            <?php
                if ($model->flg_ativo != 'N')
                    $options = array('value' => 'S', 'uncheckValue' => 'N', 'checked' => 'true');
                else
                    $options = array('value' => 'S', 'uncheckValue' => 'N');
                echo $form->checkBox($model, 'flg_ativo', $options);
            ?>
            <?php echo $form->error($model, 'flg_ativo'); ?>
        </div>
    </fieldset>

    <!--------------------Botão Salvar/Alterar--------------------->
    <div style="float: left;">	
        <?php
        $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'submit',
            'context' => $model->isNewRecord ? 'primary' : 'success',
            'label' => $model->isNewRecord ? 'Salvar' : 'Alterar',
            'htmlOptions' => array(
                'name' => 'btnClick',
            ),
        ));
        ?>
    </div>

    <!--------------------Botão Voltar--------------------------->
    <div style="float: right;">	
        <?php
        $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'button',
            'label' => 'Voltar',
            'context' => 'info',
            'htmlOptions' => array(
                'onClick' => 'js:Voltar();',
                //'class'=>'btn-menu-voltar'
            ),
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->