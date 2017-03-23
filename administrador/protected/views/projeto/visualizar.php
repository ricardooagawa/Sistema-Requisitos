<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'projeto'), 
                Yii::t('breadcrumbs', 'visualizar_projeto')
            ),
        )
);
?>

<script language="javascript">

    function Voltar() {
        window.location = '<?php echo Yii::app()->createUrl('Projeto/Buscar') ?>';
    }

</script>
<?php
//Exibe a mensagem de salvo com sucesso
$this->widget('booster.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;',
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(
        // sucesso, erro, informação
        'success' => array('closeText' => '&times;'),
    ),
));
?>
<p class="titulo"><?php echo "Visualizar Projeto"; ?></p>

<div>
    <?php
    $this->widget(
            'booster.widgets.TbDetailView',
            //Exibe os campos
            array(
                'data' => $model,
                'attributes' => array(
                    'des_projeto',
                    array('name' => 'flg_ativo', 'type' => 'raw', 'value' => ($model->flg_ativo == "S") ? "Sim" : "Não"),
                ),
            )
    );
    ?>
</div>

<!-------------------------Botão Voltar---------------------->
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
