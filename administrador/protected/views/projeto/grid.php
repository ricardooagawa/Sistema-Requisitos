<?php $this->renderPartial('_buscar', array('model' => $model, 'options'=>$options)); ?>

<?php
if (CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, $this->cod_funcionalidade, 'L'))
{
    $this->widget(
        'booster.widgets.TbExtendedGridView', array(
            //'filter' => $person,
            'fixedHeader' => false,
            'type' => 'striped bordered',
            //'headerOffset' => 40,
            'responsiveTable' => true,
            // 40px is the height of the main navigation at bootstrap
            'dataProvider' => $model->search(),
            'template' => "{summary}\n{items}\n{pager}",
            'id' => 'projeto-grid',
            'columns' => array(
                
                //Exibe os campos na view buscar
                array('name' => 'des_projeto', 'htmlOptions' => array('style' => 'width: 80%',)),
                array('name' => 'flg_ativo', 'value' => '($data["flg_ativo"]=="S"?"Sim":"Não")'),
                
                //Ícones do Alterar, Excluir e Vizualizar 
                array(
                    'header' => 'Ação',
                    'htmlOptions' => array('style' => 'width: 80px;'),
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => array(
                        'update' => array(
                            'url' => 'Yii::app()->createUrl("/Projeto/Alterar", array("codigo"=>$data["cod_projeto"]))',
                            'visible' => 'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, ' . $this->cod_funcionalidade . ',"A")',
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("/Projeto/Excluir", array("codigo"=>$data["cod_projeto"]))',
                            'visible' => 'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, ' . $this->cod_funcionalidade . ',"E")',
                        ),
                        'view' => array(
                            'url' => 'Yii::app()->createUrl("/Projeto/Visualizar", array("codigo"=>$data["cod_projeto"]))',
                            'visible' => 'CadPerfilFuncionalidade::model()->getPerfilAcao(Yii::app()->user->perfil, ' . $this->cod_funcionalidade . ',"V")',
                        ),
                    ),
                ),
                array(
                    'class' => 'EDedoDuro',
                    'name' => '',
                    'icon' => 'images/dedoduro.png',
                    'pre_alt' => 'Última alteração em',
                    'alt' => 'dat_atualizacao',
                    'fun_alt' => 'por',
                    'pos_alt' => 'cod_id_usuario',
                    'htmlOptions' => array('style' => 'width: 16px;'),
                ),
            ),
        )
    );
}
?>
