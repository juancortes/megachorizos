<?php
Yii::import('zii.widgets.grid.CGridView');
Yii::import('zii.widgets.CBaseListView');
Yii::import('zii.widgets.grid.CDataColumn');
Yii::import('zii.widgets.grid.CLinkColumn');
Yii::import('zii.widgets.grid.CButtonColumn');
Yii::import('zii.widgets.grid.CCheckBoxColumn');

class JCGridView extends CGridView {

	public $pagerCssClass='pull-right';
	public $pager=array('class'=>'JCLinkPager');
    /**
	* Initializes the controller.
	*/
	// public function init()
	// {
	// 	$this->pagerCssClass='algo';
	// }


}

?>
