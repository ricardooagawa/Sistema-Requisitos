<?php

Yii::import('zii.widgets.grid.CGridColumn');

class EDedoDuro extends CGridColumn
{

    public $name;
    public $icon;
    public $sortable;
    public $model = '';
    
    // Caminho da imagem 
    public $pathPrefix = null;
    public $pathSuffix = null;
    
    // Divide o htmlOptions para a imagem/para o link
    public $htmlOptions     = array();
    public $linkHtmlOptions = array();
    
    // Atributo Alt para a imagem (Registro alterado em...)
    public $alt;
    public $pre_alt;
    public $fun_alt;
    public $pos_alt;
    
    // Link: opcional
    public $link = false;
    public $filter = false;

    public function init()
    {
        parent::init();
        if ($this->pathPrefix === null)
            $this->pathPrefix = Yii::app()->baseUrl . '/';
        if ($this->name === null)
            throw new CException(Yii::t('zii', 'Please specify a name for EImageColumn.'));

    }

    protected function renderHeaderCellContent()
    {
        if ($this->grid->enableSorting && $this->sortable && $this->name !== null)
            echo $this->grid->dataProvider->getSort()->link($this->name, $this->header);
        else if ($this->name !== null && $this->header === null)
        {
            if ($this->grid->dataProvider instanceof CActiveDataProvider)
                echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
            else
                echo CHtml::encode($this->name);
        }
        else
            parent::renderHeaderCellContent();

    }

    // Função que monta os icones para exibição no grid
    protected function renderDataCellContent($row, $data)
    {
        if ($this->model != '')
        {
            $model = $this->model;
        }
        else
        {
            $model = $data;
        }

        //Manipula a data
        $atualizacao = Sistema::getExibeDataHora($data[$this->alt]);
        
        //Pega o nome do usuário
        $usuario     = CadUsuario::model()->getUsuario($data[$this->pos_alt]);

        if ($usuario != '')
        {
            //Monta o alt
            $title = array('title' => $this->pre_alt . ' ' . $atualizacao . ' ' . $this->fun_alt . ' ' . $usuario);
            $title += $this->htmlOptions;
            //Monta a imagem
            $image = CHtml::image(
                            $this->pathPrefix . $this->icon . $this->pathSuffix, '', $title
            );
            if ($this->link)
                echo CHtml::link($image, $this->link, $this->linkHtmlOptions);
            else
                echo $image;
        }
        else
        {
            //Monta o alt
            $title = array('title' => 'Este registro ainda não foi alterado!');
            $title += $this->htmlOptions;
            //Monta a imagem
            $image = CHtml::image(
                            $this->pathPrefix . $this->icon . $this->pathSuffix, '', $title
            );
            if ($this->link)
                echo CHtml::link($image, $this->link, $this->linkHtmlOptions);
            else
                echo $image;
        }

    }

}