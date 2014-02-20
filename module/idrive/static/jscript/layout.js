(function($){
	var initLayout = function() {
		$('#color_picker_player_background').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_player_background div').css('backgroundColor', '#' + hex);
				$('#color_picker_player_background_input').val(hex);
			}
		});
		
		$('#color_picker_player_text').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_player_text div').css('backgroundColor', '#' + hex);
				$('#color_picker_player_text_input').val(hex);
			}
		});
		
		$('#color_picker_player_buttons').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_player_buttons div').css('backgroundColor', '#' + hex);
				$('#color_picker_player_buttons_input').val(hex);
			}
		});
		
		$('#color_picker_player_progress_bar').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_player_progress_bar div').css('backgroundColor', '#' + hex);
				$('#color_picker_player_progress_bar_input').val(hex);
			}
		});
		
		$('#color_picker_chapter_background').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_chapter_background div').css('backgroundColor', '#' + hex);
				$('#color_picker_chapter_background_input').val(hex);
			}
		});
		
		$('#color_picker_chapter_text').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_chapter_text div').css('backgroundColor', '#' + hex);
				$('#color_picker_chapter_text_input').val(hex);
			}
		});
		
		$('#color_picker_playlist_arrows').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_playlist_arrows div').css('backgroundColor', '#' + hex);
				$('#color_picker_playlist_arrows_input').val(hex);
			}
		});
		
		$('#color_picker_playlist_border').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_playlist_border div').css('backgroundColor', '#' + hex);
				$('#color_picker_playlist_border_input').val(hex);
			}
		});
		

	};
	
	EYE.register(initLayout, 'init');
})(jQuery)