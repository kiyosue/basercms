<?php
/**
 * Created by PhpStorm.
 * User: kiyo
 * Date: 2016/01/30
 * Time: 14:29
 */

// BcPluginAppControllerを継承する前の準備
App::uses('BcPluginAppController', 'Controller');

class ExHelperController extends BcPluginAppController {

	public $name = 'ExHelper';

	// 管理画面接続時にログイン認証を行う設定
	public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');


	public function beforeFilter() {
		parent::beforeFilter();

		if (!preg_match('/^admin_/', $this->action)) {
			// フロント側のindexアクションの際は認証しないようにする
			$this->BcAuth->allow('index');
		} else {
			// ファイル名を指定して、サブメニューに設定する
			$this->subMenuElements = array('ex_helper');
		}
	}

	/**
	 * 管理画面用のデフォルトアクション
	 * Helpを表示して終了
	 *
	 */
	public function admin_index() {
	}


}
