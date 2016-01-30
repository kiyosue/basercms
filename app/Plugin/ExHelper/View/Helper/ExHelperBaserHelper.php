<?php
/**
 * ExHelperHelper
 * BcBaserHelper にたりないと思う機能を追加したもの
 *
 * @package ExHelper.View.Helper
 * @copyright		Copyright Since 2016 Kiyosue
 * @license			http://basercms.net/license/index.html
 */


class ExHelperBaserHelper extends AppHelper {

	public $helpers = array('ExHelper.ExBlog');


	/**
	 * 現在のページがブログかどうかを判定する
	 * pluginだけで良いのかもしれないけど、controllerもチェックしておく
	 * blogとの固定文字列比較を本当はやめたいけど、定数やconfigにはいってないのでしかたなく
	 * BlogHelper isSingle でも同様の比較をしてるので直すなら両方いっきになおす
	 *
	 * @return bool
	 */
	public function isBlog() {
		return (
			$this->request->params['plugin'] === 'blog' &&
			$this->request->params['controller'] === 'blog'
		);
	}


	/**
	 * 全てのブログのポストデータを取得
	 *
	 * @return array ブログデータ
	 *
	 */
	public function allBlogPosts($options = array()) {
		return $this->ExBlog->allBlogPosts($options);

	}

}
