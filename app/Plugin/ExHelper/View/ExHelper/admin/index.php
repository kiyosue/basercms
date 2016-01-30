<?php
/**
 * [ADMIN] Ajaxページ一覧
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 2.0.0
 * @license			http://basercms.net/license/index.html
 */
?>



<!-- ListTable -->
<table cellpadding="0" cellspacing="0" class="list-table sort-table" id="ListTable">
	<thead>
	<tr>
		<th>ヘルパー名</th>
		<th>利用箇所</th>
		<th>説明</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td colspan="3">
			※同じメソッド名がコアヘルパーに存在する場合は、そちらが優先されます。
			（読み込み順位の問題）
		</td>
	</tr>
	<tr>
		<td>isBlog()</td>
		<td>全体</td>
		<td>
			<pre>
				&lt;?php $this-BcBaser->isBlog();?&gt;
			</pre>
				blogコンテンツかどうか判別します。
		</td>
	</tr>
	<tr>
		<td>allBlogPosts()</td>
		<td>全体</td>
		<td>
			<pre>
				&lt;?php $this-BcBaser->allBlogPosts($option);?&gt;<br />
				&lt;?php $this-ExBlog->allBlogPosts($option);?&gt; // Blog配下で利用可能(上記はこちらの alias )
			</pre>
			様々な条件で、ブログの情報を取得します。(拡張途中・・・)<br />
			$option['tag'] タグで絞り込む場合にタグIDを指定（初期値 : null）<br />
			$option['content'] content.id(ブログのID) で絞り込む場合に id を指定（初期値 : null）<br />
			$option['post'] post.id(ブログ記事のID) で絞り込む場合に id を指定（初期値 : null）<br />
		</td>
	</tr>

	</tbody>
</table>

