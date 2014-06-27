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
		
		$('#color_picker_player_button_icons').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_player_button_icons div').css('backgroundColor', '#' + hex);
				$('#color_picker_player_button_icons_input').val(hex);
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
		
		$('#color_picker_menu_background').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_menu_background div').css('backgroundColor', '#' + hex);
				$('#color_picker_menu_background_input').val(hex);
				
				//For preview
				$('#preview_menu_container').css('backgroundColor', '#' + hex);
			}
		});
		
		$('#color_picker_menu_link').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_menu_link div').css('backgroundColor', '#' + hex);
				$('#color_picker_menu_link_input').val(hex);
				
				//For preview
				$('.dvs_top_menu_link').css('color', '#' + hex);
				
			}
		});
		
		$('#color_picker_text_link').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_text_link div').css('backgroundColor', '#' + hex);
				$('#color_picker_text_link_input').val(hex);
				
				//For preview
				$('#preview_dealer_website_link').css('color', '#' + hex);
				
			}
		});
		
		$('#color_picker_footer_link').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_footer_link div').css('backgroundColor', '#' + hex);
				$('#color_picker_footer_link_input').val(hex);
				
				//For preview
				$('.dvs_footer_link').css('color', '#' + hex);
				
			}
		});
		
		$('#color_picker_page_background').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_page_background div').css('backgroundColor', '#' + hex);
				$('#color_picker_page_background_input').val(hex);
				
				//For preview
				$('#dvs_container').css('backgroundColor', '#' + hex);
			}
		});
		
		$('#color_picker_page_text').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_page_text div').css('backgroundColor', '#' + hex);
				$('#color_picker_page_text_input').val(hex);
				
				//For preview
				$('.preview_dealer_info').css('color', '#' + hex);
				$('#preview_vehicle_select_container').css('color', '#' + hex);
				$('#preview_now_playing_container').css('color', '#' + hex);
			}
		});
		
		$('#color_picker_button_background').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_button_background div').css('backgroundColor', '#' + hex);
				$('#color_picker_button_background_input').val(hex);
				
				//For preview
				$('.preview_select').css('backgroundColor', '#' + hex);
			}
		});
		
		$('#color_picker_button_text').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_button_text div').css('backgroundColor', '#' + hex);
				$('#color_picker_button_text_input').val(hex);
				
				//For preview
				$('.preview_select').css('color', '#' + hex);
				$('.dvs_c2a_button').css('color', '#' + hex);
				$('.dvs_c2a_button:hover').css('color', '#' + hex);
			}
		});
		
		$('#color_picker_button_top_gradient').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_button_top_gradient div').css('backgroundColor', '#' + hex);
				$('#color_picker_button_top_gradient_input').val(hex);
				
				//For preview
				$('.dvs_c2a_button').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' + hex + '), color-stop(1, #' + $('#color_picker_button_bottom_gradient_input').val() + ') )');
				$('.dvs_c2a_button').css('background', '-moz-linear-gradient( center top, #' + hex + ' 5%, #' + $('#color_picker_button_bottom_gradient_input').val() + ' 100% )');
				$('.dvs_c2a_button').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#' + hex + '", endColorstr="#' + $('#color_picker_button_bottom_gradient_input').val() + '")');
				$('.dvs_c2a_button').css('backgroundColor', '#' + hex);
				$('.dvs_c2a_button:hover').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' + $('#color_picker_button_bottom_gradient_input').val() + '), color-stop(1, #' + hex + ') )');
				$('.dvs_c2a_button:hover').css('background', '-moz-linear-gradient( center top, #' + $('#color_picker_button_bottom_gradient_input').val() + ' 5%, #' + hex + ' 100% )');
				$('.dvs_c2a_button:hover').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#' + $('#color_picker_button_bottom_gradient_input').val() + '", endColorstr="#' + hex + '")');
				$('.dvs_c2a_button:hover').css('backgroundColor', '#' + $('#color_picker_button_bottom_gradient_input').val());
			}
		});
		
		$('#color_picker_button_bottom_gradient').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_button_bottom_gradient div').css('backgroundColor', '#' + hex);
				$('#color_picker_button_bottom_gradient_input').val(hex);
				
				//For preview
				$('.dvs_c2a_button').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' + $('#color_picker_button_top_gradient_input').val() + '), color-stop(1, #' + hex + ') )');
				$('.dvs_c2a_button').css('background', '-moz-linear-gradient( center top, #' + $('#color_picker_button_top_gradient_input').val() + ' 5%, #' + hex + ' 100% )');
				$('.dvs_c2a_button').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#' + $('#color_picker_button_top_gradient_input').val() + '", endColorstr="#' + hex + '")');
				$('.dvs_c2a_button').css('backgroundColor', '#' + $('#color_picker_button_top_gradient_input').val());
				$('.dvs_c2a_button:hover').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' + hex + '), color-stop(1, #' + $('#color_picker_button_top_gradient_input').val() + ') )');
				$('.dvs_c2a_button:hover').css('background', '-moz-linear-gradient( center top, #' + hex + ' 5%, #' + $('#color_picker_button_top_gradient_input').val() + ' 100% )');
				$('.dvs_c2a_button:hover').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#' + hex + '", endColorstr="#' + $('#color_picker_button_top_gradient_input').val() + '")');
				$('.dvs_c2a_button:hover').css('backgroundColor', '#' + hex);
			}
		});
		
		$('#color_picker_button_border').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#color_picker_button_border div').css('backgroundColor', '#' + hex);
				$('#color_picker_button_border_input').val(hex);
				
				//For preview
				$('.preview_select').css('borderColor', '#' + hex);
				$('.dvs_c2a_button').css('borderColor', '#' + hex);
				
			}
		});

        $('#color_picker_iframe_background').ColorPicker({
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color_picker_iframe_background div').css('backgroundColor', '#' + hex);
                $('#color_picker_iframe_background_input').val(hex);

                //For preview
                $('.preview_select').css('backgroundColor', '#' + hex);
            }
        });

        $('#color_picker_iframe_text').ColorPicker({
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color_picker_iframe_text div').css('backgroundColor', '#' + hex);
                $('#color_picker_iframe_text_input').val(hex);

                //For preview
                $('.preview_select').css('backgroundColor', '#' + hex);
            }
        });

        $('#color_picker_iframe_contact_background').ColorPicker({
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color_picker_iframe_contact_background div').css('backgroundColor', '#' + hex);
                $('#color_picker_iframe_contact_background_input').val(hex);

                //For preview
                $('.preview_select').css('backgroundColor', '#' + hex);
            }
        });

        $('#color_picker_iframe_contact_text').ColorPicker({
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color_picker_iframe_contact_text div').css('backgroundColor', '#' + hex);
                $('#color_picker_iframe_contact_text_input').val(hex);

                //For preview
                $('.preview_select').css('backgroundColor', '#' + hex);
            }
        });

	};
	
	EYE.register(initLayout, 'init');
})(jQuery)