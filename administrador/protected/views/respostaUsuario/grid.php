<?php $this->renderPartial('_buscar',array('model'=>$model)); ?>
<?php
if(CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade,'L'))
{
    $this->widget(
        'booster.widgets.TbExtendedGridView',
        array(
            'fixedHeader' => false,
            'type' => 'striped bordered',
            'responsiveTable' => true,
            'dataProvider'=>$model->filtroRespostaUsuario(),
            'template' => "{summary}\n{items}\n{pager}",
            'id'=>'perfil-grid',
            'columns'=>array(
                array('name' =>'des_assunto','htmlOptions'=>array('width'=>'600px', )),
                array('name' =>'des_descricao','htmlOptions'=>array('width'=>'600px', )),
                array('name' =>'dat_inicio','value'=>'Sistema::getExibeData($data["dat_inicio"])', 'htmlOptions'=>array('width'=>'600px', )),
                array('name' =>'dat_termino','value'=>'Sistema::getExibeData($data["dat_termino"])', 'htmlOptions'=>array('width'=>'600px', )),
                array(
                    'header' => 'Ação',
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template'=>'{responder}',

                    'buttons'=>array(
                       'responder'=>array(
                                'url'=>'Yii::app()->createUrl("/RespostaUsuario/Responder", array("codigo"=>$data["cod_assunto"]))',
                                'label'=>'',
                                'visible'=>'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, '.$this->cod_funcionalidade.',"R")',
                                'options'=>array(
                                        'class'=>'glyphicon glyphicon-tasks',
                                        'title'=>'Responder',
                                ),
                        ),
                    ),
                ),
            ),
        )
    );
}
?>
