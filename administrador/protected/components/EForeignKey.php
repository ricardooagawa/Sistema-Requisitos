<?php

Yii::import('zii.widgets.grid.CGridColumn');

class EForeignKey extends CGridColumn
{

    public $name;
    public $sortable;
    public $pathPrefix;
    
    // Divide o htmlOptions para o grid
    public $htmlOptions = array();
    
    // Parametro para a função que vai buscar a exibição
    public $param;
    public $param2;
    public $param3;
    public $param4;
    public $param5;
    public $param6;
    public $param7;
    public $param8;
    public $param9;
    
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

    protected function renderDataCellContent($row, $data)
    {
        if ($this->param)
        {
            $fk    = $data->getFk($data->{$this->param});
            $image = "<center>" . $fk . "</center>";
        }
        if ($this->param2)
        {
            $fk2   = $data->getFk2($data->{$this->param2});
            $image = $fk2;
        }
        if ($this->param3)
        {
            $fk3   = $data->getFk3($data->{$this->param3});
            $image = $fk3;
        }
        if ($this->param4)
        {
            $fk4   = $data->getFk4($data->{$this->param4});
            $image = $fk4;
        }
        if ($this->param5)
        {
            $fk5   = $data->getFk5($data->{$this->param5});
            $image = $fk5;
        }
        if ($this->param6)
        {
            $fk6   = $data->getFk6($data->{$this->param6});
            $image = $fk6;
        }
        if ($this->param7)
        {
            $fk7   = $data->getFk7($data->{$this->param7});
            $image = $fk7;
        }
        if ($this->param8)
        {
            $fk8   = $data->getFk8($data->{$this->param8});
            $image = $fk8;
        }
        if ($this->param9)
        {
            $fk9   = $data->getFk9($data->{$this->param9});
            $image = $fk9;
        }
        if ($this->link)
            echo CHtml::link($image, $this->link, $this->linkHtmlOptions);
        else
            echo $image;

    }

}