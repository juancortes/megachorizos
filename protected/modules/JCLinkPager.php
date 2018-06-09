<?php
Yii::import('system.web.widgets.pagers.CLinkPager');
// framework/web/widgets/pagers/CLinkPager.php

class JCLinkPager extends CLinkPager{

	public $firstPageCssClass='';
	public $htmlOptions=array('class'=>'pagination');
	public $header='';
	public $selectedPageCssClass='active';
	public $hiddenPageCssClass='disabled';

	/**
	* Initializes the pager by setting some default property values.
    */
	public function init()
	{
		if($this->nextPageLabel===null)
			$this->nextPageLabel=Yii::t('yii','&raquo;');
		if($this->prevPageLabel===null)
			$this->prevPageLabel=Yii::t('yii','&laquo;');
		if($this->firstPageLabel===null)
			$this->firstPageLabel=Yii::t('yii','&laquo;&laquo;');
		if($this->lastPageLabel===null)
			$this->lastPageLabel=Yii::t('yii','&raquo;&raquo;');
		if($this->header===null)
			$this->header=Yii::t('yii','Go to page: ');

		if(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']=$this->getId();
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='yiiPager';
	}

}

?>
