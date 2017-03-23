<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'configuracoes'),
                Yii::t('breadcrumbs', 'perfil'), 
                Yii::t('breadcrumbs', 'visualizar_perfil')
            ),
        )
);
?>

<script language="javascript">

    function Voltar() {
        window.location = '<?php echo Yii::app()->createUrl('Perfil/Buscar') ?>';
    }

</script>

<p class="titulo"><?php echo "Visualização de Perfil de Acesso"; ?></p>

<?php
//Exibe a mensagem de salvo com sucesso
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
            'booster.widgets.TbDetailView', array(
        'data' => $model,
        'attributes' => array(
            'des_perfil',
        ),
            )
    );
    ?>
    <br><br>
    <p class="titulo"><?php echo "Funcionalidades"; ?></p>

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'perfil-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
            ));
    ?>
    <?php
    $funcionalidades = BasFuncionalidade::model()->findAllBySql('SELECT * FROM tb_bas_funcionalidade ORDER BY des_funcionalidade ASC');
    $contador = 0;
    if (!empty($funcionalidades)) {
        foreach ($funcionalidades as $cont => $registro) {
            if ($registro['flg_ativo'] != 'N') {
                echo "<div class='row' style='margin-left:2.5%;'><br><b>" . $registro['des_funcionalidade'] . "</b></div>";
                $permissao = BasFuncionalidadeAcao::model()->findAllBySql("select * from tb_bas_funcionalidade_acao where cod_funcionalidade=" . $registro['cod_funcionalidade'] . " order by cod_funcionalidade, cod_acao asc");
                if (!empty($permissao)) {
                    foreach ($permissao as $chave => $acao) {
                        echo "<div class='row'>";
                        if ($model->cod_perfil != '') {
                            $perfilfuncionalidade = CadPerfilFuncionalidade::model()->findBySql("select * from tb_cad_perfil_funcionalidade where cod_perfil=" . $model->cod_perfil . " and cod_funcionalidade_acao='" . $acao->cod_funcionalidade_acao . "'");
                            if (isset($perfilfuncionalidade)) {
                                //Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
                                $options = array('disabled' => 'disabled', 'value' => '1', 'uncheckValue' => '0', 'checked' => 'true', 'id' => 'cod_acao' . $acao->cod_funcionalidade_acao, 'name' => 'cod_acao' . $acao->cod_funcionalidade_acao);
                            } else {
                                //Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
                                $options = array('disabled' => 'disabled', 'value' => '1', 'uncheckValue' => '0', 'id' => 'cod_acao' . $acao->cod_funcionalidade_acao, 'name' => 'cod_acao' . $acao->cod_funcionalidade_acao);
                            }
                        } else {
                            //Value alterado de 'S' para '1' devido ao cod_acao='S' vir sempre checado
                            $options = array('disabled' => 'disabled', 'value' => '1', 'uncheckValue' => '0', 'checked' => 'true', 'id' => 'cod_acao' . $acao->cod_funcionalidade_acao, 'name' => 'cod_acao' . $acao->cod_funcionalidade_acao);
                        }
                        echo $form->checkbox($acao, 'cod_acao', $options) . ' ';
                        echo $form->label($acao, 'cod_acao', array('label' => $acao->getAcaoNome($acao->cod_acao)));
                        echo "</div>";
                    }
                }
            }
            $contador++;
        }
    }
    ?>
    <?php $this->endWidget(); ?>
</div>

<div style="float: right;">	
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'button',
        'label' => 'Voltar',
        'context' => 'info',
        'htmlOptions' => array(
            'onClick' => 'js:Voltar();',
        ),
    ));
    ?>
</div>