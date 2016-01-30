<?php
/**
 * ExBlogHelper
 *
 * BcBaserHelper にたりないと思う機能を追加したもの
 *
 * @package ExHelper.View.Helper
 *
 * @property BlogPost $BlogPost
 */

App::uses('BlogHelper', 'Blog.View/Helper');

class ExBlogHelper extends BlogHelper {

	/**
	 * コンストラクタ
	 *
	 * @param View $View ビュークラス
	 * @param array $settings ヘルパ設定値（BcBaserHelper では利用していない）
	 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}


	/**
	 * 指定ブログで公開状態の記事を取得
	 *
	 * ページ編集画面等で利用する事ができる。
	 * ビュー: lib/Baser/Plugin/Blog/View/blog/{コンテンツテンプレート名}/posts.php
	 *
	 * 《利用例》
	 * $this->BcBaser->allBlogPosts('news', 3)
	 *
	 * @param int $contentsName 管理システムで指定したコンテンツ名
	 * @param int $num 記事件数（初期値 : 5）
	 * @param array $options オプション（初期値 : array()）
	 *	- `tag` : タグで絞り込む場合にタグ名を指定（初期値 : null）
	 *	- `content` : content.id(ブログのID) で絞り込む場合に id を指定（初期値 : null）
	 *	- `post` : post.id(ブログ記事のID) で絞り込む場合に id を指定（初期値 : null）
	 *	- `category` : カテゴリで絞り込む場合にアルファベットのカテゴリ名指定（初期値 : null）
	 *	- `year` : 年で絞り込む場合に年を指定（初期値 : null）
	 *	- `month` : 月で絞り込む場合に月を指定（初期値 : null）
	 *	- `day` : 日で絞り込む場合に日を指定（初期値 : null）
	 *	- `keyword` : キーワードで絞り込む場合にキーワードを指定（初期値 : null）
	 *	- `template` : 読み込むテンプレート名を指定する場合にテンプレート名を指定（初期値 : null）
	 *	- `direction` : 並び順の方向を指定 [昇順:ASC or 降順:DESC]（初期値 : null）
	 *	- `sort` : 並び替えの基準となるフィールドを指定（初期値 : null）
	 *	- `page` : ページ数を指定（初期値 : null）
	 * @return void
	 */
	public function allBlogPosts($options = array()){

		$options = array_merge(array(
			'category' => null,
			'tag' => null,
			'year' => null,
			'month' => null,
			'day' => null,
			'content' => null,
			'post' => null,
			'keyword' => null,
			'template' => null,
			'direction' => null,
			'page' => null,
			'sort' => null
		), $options);

		$BlogPost = ClassRegistry::init('Blog.BlogPost');

		$conditions = $BlogPost->getConditionAllowPublish() ;


		if( $options['content'] !== null ){
			$conditions['BlogContent.id'] = $options['content'] ;
		}

		if( $options['post'] !== null ){
			$conditions['BlogPost.id'] = $options['post'] ;
		}

		if( $options['tag'] !== null ){
			//SELECT blog_post_id FROM mysite_pg_blog_posts_blog_tags WHERE blog_tag_id IN (1,2,3) GROUP BY blog_post_id;
			$BlogPostsBlogTag = ClassRegistry::init('ExHelper.BlogPostsBlogTag');
			$tags = $BlogPostsBlogTag->find('all',array(
					'fields' => array(
						'BlogPostsBlogTag.blog_post_id'
					),
					'conditions' => array(
						'BlogPostsBlogTag.blog_tag_id' => $options['tag'],
					),
					'group' => 'BlogPostsBlogTag.blog_post_id',
					'cache' => false //キャッシュはオフに
				)
			);
			if(is_array($tags)){
				$tagId = null;
				foreach($tags as $val){
					$tagId[] = $val['BlogPostsBlogTag']['blog_post_id'];
				}
			}
			if(! empty($conditions['BlogPost.id']) ){
				$postId = null;
				if( is_numeric($conditions['BlogPost.id'])){
					foreach($tagId as $val){
						if($val == $conditions['BlogPost.id']){
							$postId = $val;
							break ;
						}
					}
				} else if( is_array($conditions['BlogPost.id'])){
					foreach($tagId as $val){
						if(in_array($val, $conditions['BlogPost.id'])){
							$postId[] = $val;
						}
					}
				}
				$conditions['BlogPost.id'] = $postId ;
			} else {
				$conditions['BlogPost.id'] = $tagId ;
			}
		}

		$posts = $BlogPost->find('all', array(
			'fields' => array(
				'BlogPost.id',
				'BlogPost.name',
			),
			'conditions' => $conditions,
			'order' => array('BlogPost.posts_date DESC'), //公開日順にソート
			'limit' => 1000, //取得記事数
			'cache' => false //キャッシュはオフに
		));


		return $posts ;
	}
}
