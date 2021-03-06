<?php
/**
 * [ADMIN] グローバルメニュー一覧
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2014, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2014, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
$this->BcBaser->js(array(
	'admin/jquery.baser_ajax_data_list',
	'admin/jquery.baser_ajax_batch',
	'admin/jquery.baser_ajax_sort_table',
	'admin/baser_ajax_data_list_config',
	'admin/baser_ajax_batch_config'
));
?>


<?php $this->BcBaser->js('admin/sorttable', false) ?>
<script type="text/javascript">
$(function(){
	$.baserAjaxDataList.init();
	$.baserAjaxSortTable.init({ url: $("#AjaxSorttableUrl").html()});
	$.baserAjaxBatch.init({ url: $("#AjaxBatchUrl").html()});
});
</script>

<div id="AjaxBatchUrl" style="display:none"><?php $this->BcBaser->url(array('controller' => 'menus', 'action' => 'ajax_batch')) ?></div>
<div id="AjaxSorttableUrl" style="display:none"><?php $this->BcBaser->url(array('controller' => 'menus', 'action' => 'ajax_update_sort')) ?></div>
<div id="AlertMessage" class="message" style="display:none"></div>
<div id="MessageBox" style="display:none"><div id="flashMessage" class="notice-message"></div></div>
<div id="DataList"><?php $this->BcBaser->element('menus/index_list') ?></div>