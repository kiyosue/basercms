/**
 * 指定のform編集中にページを離脱しようとした時に警告ダイアログをだす。
 */
$(function() {

	var alertDialogFormName = false ;
	var alertDialogObjectValue = {} ;
	var CkeditorUseId = [] ;

	$(window).load(function(){
		alertDialogFormName = "#" + $("#AdminAlertDialog").attr('form-name');
		jQuery.each(CKEDITOR.instances, function(i, field){
			CkeditorUseId.push(i);
		});

		//Ckeditor要素を取り除く
		jQuery.each($(alertDialogFormName).serializeArray(), function(i, field){
			formId = $(alertDialogFormName + ' [name="' + field.name + '"]').attr('id') ;
			if( $.inArray(formId, CkeditorUseId) === -1 ) {
				if( formId ){
					alertDialogObjectValue[formId] = field.value ;
				}
			}
		});
	});

	$(window).on('beforeunload', function () {
		var changeFlag = false;
		var alertDialogObjectNewValue = {} ;

		//Ckeditor要素以外を比較
		jQuery.each($(alertDialogFormName).serializeArray(), function(i, field){
			formId = $(alertDialogFormName + ' [name="' + field.name + '"]').attr('id') ;
			if( $.inArray(formId, CkeditorUseId) === -1 ) {
				if( formId ){
					alertDialogObjectNewValue[formId] = field.value ;
				}
			}
		});

		if( JSON.stringify(alertDialogObjectValue) == JSON.stringify(alertDialogObjectNewValue) ){
			//ckeditor check
			jQuery.each(CkeditorUseId, function(i, field){
				if( CKEDITOR.instances[field].getData() !== $("#"+ field.replace( /Tmp$/ , "")).val() ){
					changeFlag = true ;
				}
			});
		} else {
			changeFlag = true ;
		}

		if( changeFlag ){
			return false ;
		}
	});

	// Submitの場合のみ ページ離脱イベント解除
	$('#BtnSave').on('click', function () {
		$(window).off('beforeunload');
	});
});
