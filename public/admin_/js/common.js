/*アコーディオン*/
$(function(){
	$('.ac_toggle').on("click", function() {
		$(this).toggleClass('opened').next().slideToggle();
	});
});

/*フルスクリーン*/
$(function(){
	$('.fullscreen_toggle').on("click", function() {
		$('.fix_search').toggleClass('opened').next().slideToggle();
	});
});
$(function(){
	$('.fullscreen_toggle').on("click", function() {
		$('.fix_menu').toggleClass('opened').next().slideToggle();
	});
});

/*ページトップ*/
$(function () {
	var startPos = 0,winScrollTop = 0;
	$(window).on("scroll", function() {
		windowWidth = $(window).width();
		windowPc = 1048;
		scrollHeight = $(document).height();
		scrollPosition = $(window).height() + $(window).scrollTop();
		footerHeight = $(".footer_wrapper").innerHeight();
		winScrollTop = $(window).scrollTop();

		//表示位置レスポンシブ対応
		if (windowWidth < windowPc) { //横幅1048px未満
		if ( scrollHeight - scrollPosition  <= footerHeight - 142 ) {
			$("#page_top").css({
			"position":"absolute",
			"bottom": footerHeight - 16
			});
		} else {
			$("#page_top").css({
			"position":"fixed",
			"bottom": "120px",
			});
		}
		} else { //横幅1048px以上
		$("#page_top").css({
			"position":"fixed",
			"bottom": "56px",
		});
		}

		//スクロールでの表示_非表示
		if (winScrollTop && winScrollTop < startPos) {
		$('#page_top').removeClass('opacity0').addClass('opacity1');
		} else {
		$('#page_top').removeClass('opacity1').addClass('opacity0');
		}
		startPos = winScrollTop;
	});
});

/*フォーム*/
$(function($){
	const Target = $('.is-empty');
	$(Target).on('change', function(){
	  if ($(Target).val() !== ""){
		$(this).removeClass('is-empty');
	  } else {
		$(this).addClass('is-empty');
	  }
	});
});

/*フォーム入力中で画面遷移しようとするとアラート*/
$(function(){
	var form_change_flg = false;
	$(window).on('beforeunload', function() {
		if (form_change_flg) {
			return "入力画面を閉じようとしています。入力中の情報がありますがよろしいですか？";
		}
	});
	//フォームの内容が変更されたらフラグを立てる
	$('form input').change(function() {
		form_change_flg = true;
	});
	$('form textarea').change(function() {
		form_change_flg = true;
	});
	// フォーム送信時はアラートOFF
	$('form').submit(function(){
		form_change_flg = false;
	});
	// 検索時はアラートOFF
	$('.bt_submit').click(function(){
		form_change_flg = false;
	});
});

// トースト表示
$(function () {
	$('.bt_toast').on('click', function () {
		$('#toast').addClass('on');
		setTimeout(function () {
			$('#toast').removeClass('on');
		}, 1000);
	});
});
$(function () {
	$('.bt_toast_reset').on('click', function () {
		$('#toast_reset').addClass('on');
		setTimeout(function () {
			$('#toast_reset').removeClass('on');
		}, 1000);
	});
});

// ナビゲーションメニューの背景色を変える
$(function(){
	var url = location.origin + location.pathname + location.search;
	  $('nav li a').each(function(){
		  var $href = $(this).prop('href');
		  if (url === $href) {
			  $(this).parents('.ac_box,li').addClass('current');
		  }
	});
});


// .max975のpadding-bottomの値を決める
// $(function(){
// 	var vh = $(window).height();
// 	var header = $('.fix_menu').height();
// 	var main = $('main').height();
// 	var footer = $('.footer_wrapper').height();
// 	var height = vh - header - main - footer;
// 	if (window.matchMedia('(min-height: 670px)').matches){
// 		$('.max975').css('padding-bottom',height);
// 	}else{
// 		$('.max975').css('padding-bottom',150);
// 	}
// });

// まとめて削除ボタン
$(function() {
	$('.check_delete').change(function() {
		var len = $('.check_delete:checked').length;
		if (len >= 1) {
		$('.delete').prop('disabled', false);
		} else {
		$('.delete').prop('disabled', true);
		}
	});
});
// 削除アラート
$(function(){
	$('.delete,.bt_delete').on('click',function(){
		var res = confirm("本当に削除しますか？");
		if( res == true ) {

		}else {
            return false;
		}
	});
});

// 選択削除ボタンモード
$(function(){
	$('.check_delete').prop('disabled',true).parent('label').css('cursor','default');
	$('.bt_choice').on('click',function(){
		var check = $('.check_delete');
		if($('#choice').prop("checked") == true){
			$(check).prop('disabled',false);
			$(check).prop('disabled',false).parent('label').css('cursor','pointer');
			$('.tgl_bt,.bt_edit').addClass('disabled');
			$('.delete').css('display','flex');
			$('.add').hide();
			$(check).on('change',function() {
				var len = $('.check_delete:checked').length;
				if (len >= 1) {
					$('.delete').prop('disabled', false);
				}else{
					$('.delete').prop('disabled', true);
				}
			});
			$(check).on('change',function() {
				if($(this).prop("checked") == true){
					$(this).next('.list_box').css('background','#ffe1d9');
				}else{
					$(this).next('.list_box').css('background','#fff');
				}
			});
		}else{
		$(check).prop('disabled',true);
		$(check).prop('disabled',true).parent('label').css('cursor','default');
		$('.tgl_bt,.bt_edit').removeClass('disabled');
		$('.delete').hide();
		$('.add').show();
		$(check).removeAttr("checked").prop("checked", false).change();
		}
	})
})

// 登録しましたバルーンを削除
$(function () {
	$('.bubbly_box').on('click', function () {
		$(this).addClass('bubbly_box_hide');
	});
});

/*SEOタグ入力フォーム*/
// まとめて編集ボタンの活性化・非活性化
function changeSelectBoxes() {
    const checkboxes = $('input[type="checkbox"]');
    const selectedValues = checkboxes.filter(':checked').map(function() {
        return this.value;
    }).get();

    if (selectedValues.length > 0) {
        $('.bt_edit.pages').prop('disabled', false);
        $('.bt_edit.pages').removeClass('disabled');
        // 各ページをチェックされた場合、「全てのページ」のチェックを解除
        $('.check_all').removeAttr("checked").prop("checked", false);
    } else {
        $('.bt_edit.pages').prop('disabled', true);
        $('.bt_edit.pages').addClass('disabled');
    }
}

function changeSelectAll() {
    const checkboxes = $('input[type="checkbox"]');
    const selectedValues = checkboxes.filter(':checked').map(function() {
        return this.value;
    }).get();

    if (selectedValues.length > 0) {
        $('.bt_edit.pages').prop('disabled', false);
        $('.bt_edit.pages').removeClass('disabled');
        if ($.inArray(selectedValues, 'all') ) {
            // 「全てのページ」をチェックされた場合、各ページのチェックを解除
            $('.check_items').removeAttr('checked').prop('checked', false);
        } else {
            // 各ページをチェックされた場合、「全てのページ」のチェックを解除
            $('.check_all').removeAttr('checked').prop('checked', false);
        }
    } else {
        $('.bt_edit.pages').prop('disabled', true);
        $('.bt_edit.pages').addClass('disabled');
    }
}

// チェックボックスをクリックした時にindexの情報を入力
$(function () {
	$('.reflect').on('click', function () {
        let id = $(this).prop('id');
        if ($(this).prop('checked')) {
            // indexページの情報を取得
            let title = $('#pageinfo_index_title').val();
            let description = $('#pageinfo_index_description').val();
            let h1 = $('#pageinfo_index_h1').val();
            let keywords = $('#pageinfo_index_keywords').val();

            // チェックされた項目にページ情報を入力
            $('#pageinfo_' + id + '_title').val(title);
            $('#pageinfo_' + id + '_description').val(description);
            $('#pageinfo_' + id + '_h1').val(h1);
            $('#pageinfo_' + id + '_keywords').val(keywords);
        } else {
            // チェックされた項目のページ情報の入力を削除
            $('#pageinfo_' + id + '_title').val('');
            $('#pageinfo_' + id + '_description').val('');
            $('#pageinfo_' + id + '_h1').val('');
            $('#pageinfo_' + id + '_keywords').val('');
        }
	});
});
