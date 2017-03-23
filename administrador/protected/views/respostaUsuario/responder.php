<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs', array(
    'links' => array(
                Yii::t('breadcrumbs', 'cadastros'),
                Yii::t('breadcrumbs', 'requisitos'), 
                Yii::t('breadcrumbs', 'preencher_requisitos')
            ),
        )
);
?>

<script language="javascript">

    function Voltar() {
        window.location = '<?php echo Yii::app()->createUrl('RespostaUsuario/Buscar') ?>';
    }

</script>

<div class="wide form">
    
<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
        'booster.widgets.TbActiveForm', array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
        )
);
?>

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
    
    <p class="titulo"><?php echo "Preencher Requisitos"; ?></p>

    <?php

    //Cabeçalho do assunto 
    echo '<div style="margin: 25px;">';
    echo '<h4><b>'.$modelAssuntoTopico[0]['des_assunto'].'</b></h4>'; 
    echo '<h5><i>'.$modelAssuntoTopico[0]['des_descricao'].'</i></h5>'; 
    echo '</div>';
    
    //Verifica se a data de termino e a data de inicio esta em vigência para que o usuário possa responder o formulário
    $form_liberado= CadAssunto::model()->getPermissaoRespostaRequito($modelAssuntoTopico[0]['dat_inicio'], $modelAssuntoTopico[0]['dat_termino']);
    
    if($form_liberado === true)
    {
        echo '<div class="alert alert-info" role="info">';
        echo 'Esse formulário se encerrou em '. Sistema::getExibeData($modelAssuntoTopico[0]['dat_termino']);
        echo '</div>';
    }
    
    foreach($modelAssuntoTopico as $chave=>$topico)
    {    
        //Captura os atributos de resposta do assunto e tópicos
        $modelRespostaTopico= CadRespostaTopico::model()->getRespostaTopico($topico['cod_assunto'], $topico['cod_assunto_topico']);

        //Verifica se a pesquisa retornou algum registro 
        if(empty($modelRespostaTopico))
        {
            echo '<div class="panel panel-warning">
                    <div class="panel-heading">
                       <h3 class="panel-title"><span class="glyphicon glyphicon-remove"></span>'.$topico['des_topico'].'</h3>
                    </div>
                    <div class="panel-body">';
            
                    $this->widget(
                        'booster.widgets.TbCKEditor',
                        array(
                            'name' => 'topico['.$topico['cod_assunto_topico'].'][des_resposta_topico]',
                            'value' => '',
                            'htmlOptions'=>array('disabled'=>$form_liberado),
                            'editorOptions' => array(
                                // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
                                'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
                            )
                        )
                    );
            
            echo '  </div>
                  </div>';
        }
        else
        {
            echo '<div class="panel panel-success">
                    <div class="panel-heading">
                       <span class="panel-title"><span class="glyphicon glyphicon-ok"></span>'.$topico['des_topico'].'</span>
                       <span style="float: right;"> Respondido em: '.Sistema::getExibeDataHora($modelRespostaTopico[0]['dat_atualizacao']).'</span>
                    </div>
                    <div class="panel-body">';
            
                    $this->widget(
                        'booster.widgets.TbCKEditor',
                        array(
                            'name' => 'topico['.$topico['cod_assunto_topico'].'][des_resposta_topico]',
                            'value' => $modelRespostaTopico[0]['des_resposta_topico'],
                            'htmlOptions'=>array('disabled'=>$form_liberado),
                            'editorOptions' => array(
                                // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
                                'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
                            )
                        )
                    );
            
            echo '  </div>
                  </div>';
        }
    }

    ?>
    
    <!--------------------Botão Salvar/Alterar--------------------->
    <div style="float: left;">	
        <?php
        $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'submit',
            'context' => 'primary',
            'label' => 'Salvar',
            'htmlOptions' => array(
                'name' => 'btnClick',
                'disabled'=>$form_liberado,
            ),
        ));
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

<?php $this->endWidget(); ?>

</div>