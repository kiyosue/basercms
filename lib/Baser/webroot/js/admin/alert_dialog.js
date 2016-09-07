/**
 * 編集中にページを離脱しようとした時の挙動
 */
$(function() {
	$(window).on('beforeunload', function () {
		return false;
	});

	// Submitの場合のみ ページ離脱イベント解除
	$('#BtnSave').on('click', function () {
		$(window).off('beforeunload');
	});
});
