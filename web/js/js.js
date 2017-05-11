$(document).ready(function() {
	//cartload();

	$(".style_grid").click(function() {
		$("#product_list_list").hide();
		$("#product_list_grid").show();

		$(".style_grid img").attr("src","/style/img/grid-active.png");
		$(".style_list img").attr("src","/style/img/list-passive.png");

		$.cookie('select_style','grid');
	});
	$(".style_list").click(function() {
		$("#product_list_grid").hide();
		$("#product_list_list").show();

		$(".style_grid img").attr("src","/style/img/grid-passive.png");
		$(".style_list img").attr("src","/style/img/list-active.png");

		$.cookie('select_style','list');
	});

	if ($.cookie('select_style') == 'grid') {
		$("#product_list_list").hide();
		$("#product_list_grid").show();

		$(".style_grid img").attr("src","/style/img/grid-active.png");
		$(".style_list img").attr("src","/style/img/list-passive.png");
	}

	else {
		$("#product_list_grid").hide();
		$("#product_list_list").show();

		$(".style_grid img").attr("src","/style/img/grid-passive.png");
		$(".style_list img").attr("src","/style/img/list-active.png");
	}



	$("#p_sort span").click(function(){
		var sort_class = $("#style_sort").attr("class");
		if (sort_class == "sort_passive") {
			$("#style_sort").slideDown(200);
			$("#style_sort").removeClass("sort_passive");
			$("#style_sort").addClass("sort_active");
			return false;
		}

		if (sort_class == "sort_active") {
			$("#style_sort").slideUp(200);
			$("#style_sort").removeClass("sort_active");
			$("#style_sort").addClass("sort_passive");
		}

	});




	$(".reg").click(function(){
		$("#registration_black").fadeIn(200);
		$("#registration").fadeIn(200);
		$("#registration").css("position","fixed");
	});

	$("#registration_black").click(function() {
		$("#registration").fadeOut(200);
		$("#registration_black").fadeOut(200);
		$("#registration_message").fadeOut(200);
		$("#registration_error_message").fadeOut(200);

	});

	$(".registration_cancel").click(function() {
		$("#registration").fadeOut(200);
		$("#registration_black").fadeOut(200);
		$("#registration_error_message").fadeOut(200);
	});


	$(".log").click(function(){
		$("#autorization_black").fadeIn(200);
		$("#autorization").fadeIn(200);
		$("#autorization").css("position","fixed");
	});
	$("#autorization_black").click(function() {
		$("#autorization").fadeOut(200);
		$("#autorization_black").fadeOut(200);
		$("#registration_error_message").fadeOut(200);
		$("#forgotten").fadeOut(200);
	});

	$(".autorization_cancel").click(function() {
		$("#autorization").fadeOut(200);
		$("#autorization_black").fadeOut(200);
		$("#registration_error_message").fadeOut(200);
	});

	$("#account_a").click(function(){
		$("#registration").fadeOut(200);
		$("#registration_black").fadeOut(200);
		$("#autorization_black").fadeIn(200);
		$("#autorization").fadeIn(200);
		$("#autorization").css("position","fixed");
	});

	$("#dont_have_account_a").click(function(){
		$("#autorization").fadeOut(200);
		$("#autorization_black").fadeOut(200);
		$("#registration_black").fadeIn(200);
		$("#registration").fadeIn(200);
		$("#registration").css("position","fixed");
	});

	$("#registration_message p.reg_close").click(function() {
		$("#registration_message").fadeOut(200);
		$("#message_black").fadeOut(400);
		window.location.reload();
	});

	$("#registration_error_message p.reg_error_close").click(function() {
		$("#registration_error_message").fadeOut(200);
	});

	$("#message_black").click(function(){
		$("#registration_message").fadeOut(200);
		$("#message_black").fadeOut(400);
		window.location.reload();
	});

	$(".forgotten_cancel").click(function(){
		$("#forgotten").fadeOut(200);
		$("#autorization_black").fadeOut(200);
	});

	$("#forgot_pass").click(function(){
		$("#autorization").fadeOut(200);
		$("#forgotten").fadeIn(200);
	});

	$("#i_remember_account_p").click(function(){
		$("#forgotten").fadeOut(200);
		$("#autorization").fadeIn(200);
	});

	var user_width = $("#l_auto_div").width();
	$("#user_inform").width(user_width);

	$("body").click(function(){

		var user_class_body = $("#user_inform").attr("class");
		var sort_class_body = $("#style_sort").attr("class");

		if (user_class_body == "user_active") {
				$("#user_inform").slideUp(200);
				$("#user_inform").removeClass("user_active");
				$("#user_inform").addClass("user_passive").delay(1000);
			}

		if (sort_class_body == "sort_active") {
			$("#style_sort").slideUp(200);
			$("#style_sort").removeClass("sort_active");
			$("#style_sort").addClass("sort_passive");
		}
});
	$(".user").click(function(){
			var user_class = $("#user_inform").attr("class");

			if (user_class == "user_active") {
				$("#user_inform").slideUp(200);
				$("#user_inform").removeClass("user_active");
				$("#user_inform").addClass("user_passive");
			}
			if (user_class == "user_passive") {
				$("#user_inform").slideDown(200);
				$("#user_inform").removeClass("user_passive");
				$("#user_inform").addClass("user_active");
				$("#user_inform").css("display","flex");
				return false;
			}
	});
	/*$("#a_user,#user_inform").hover(function(){
	var user_class = $("#user_inform").attr("class");

			if (user_class == "user_active") {
				$("#user_inform").slideUp(200);
				$("#user_inform").removeClass("user_active");
				$("#user_inform").addClass("user_passive");
			}
			if (user_class == "user_passive") {
				$("#user_inform").slideDown(200);
				$("#user_inform").removeClass("user_passive");
				$("#user_inform").addClass("user_active");
				$("#user_inform").css("display","flex");
			}
	});*/

		$("#show-hide").click(function(){
			var status = $("#show-hide").attr("class");
				if (status == "show-active") {
					$("#show-hide").removeClass("show-active");
					$("#show-hide").addClass("show-passive");

					$("#show-hide").html("Скрыть");
					$("#autorization_password").attr("type","text");
				}

				if (status == "show-passive") {
					$("#show-hide").removeClass("show-passive");
					$("#show-hide").addClass("show-active");

					$("#show-hide").html("Показать");
					$("#autorization_password").attr("type","password");
				}
		});

			$("#show_hide_pass_one").click(function(){
			var status = $("#show_hide_pass_one").attr("class");
				if (status == "show-active") {
					$("#show_hide_pass_one").removeClass("show-active");
					$("#show_hide_pass_one").addClass("show-passive");

					$("#show_hide_pass_one").html("Скрыть");
					$("#user_change_current_password").attr("type","text");
				}

				if (status == "show-passive") {
					$("#show_hide_pass_one").removeClass("show-passive");
					$("#show_hide_pass_one").addClass("show-active");

					$("#show_hide_pass_one").html("Показать");
					$("#user_change_current_password").attr("type","password");
				}
		});
			$("#show_hide_pass_two").click(function(){
			var status = $("#show_hide_pass_two").attr("class");
				if (status == "show-active") {
					$("#show_hide_pass_two").removeClass("show-active");
					$("#show_hide_pass_two").addClass("show-passive");

					$("#show_hide_pass_two").html("Скрыть");
					$("#user_change_password").attr("type","text");
				}

				if (status == "show-passive") {
					$("#show_hide_pass_two").removeClass("show-passive");
					$("#show_hide_pass_two").addClass("show-active");

					$("#show_hide_pass_two").html("Показать");
					$("#user_change_password").attr("type","password");
				}
		});
			$("#show_hide_pass_three").click(function(){
			var status = $("#show_hide_pass_three").attr("class");
				if (status == "show-active") {
					$("#show_hide_pass_three").removeClass("show-active");
					$("#show_hide_pass_three").addClass("show-passive");

					$("#show_hide_pass_three").html("Скрыть");
					$("#user_change_sec_password").attr("type","text");
				}

				if (status == "show-passive") {
					$("#show_hide_pass_three").removeClass("show-passive");
					$("#show_hide_pass_three").addClass("show-active");

					$("#show_hide_pass_three").html("Показать");
					$("#user_change_sec_password").attr("type","password");
				}
		});

			
			function number_rank_js(int) {
				var total = String(int);
				var lenstr = total.length;

				switch(lenstr) {
					case 4: {
						rank_price = total.substring(0,1)+" "+total.substring(1,4);
						break;
					}
					case 5: {
						rank_price = total.substring(0,2)+" "+total.substring(2,5);
						break;
					}
					case 6: {
						rank_price = total.substring(0,3)+" "+total.substring(3,6);
						break;
					}
					case 7: {
						rank_price = total.substring(0,1)+" "+total.substring(1,3)+" "+total.substring(4,7);
						break;
					}
					default: {
						rank_price = total;
					}
				}
				return rank_price;
			}

			$("#cart_black").click(function() {
				$("#cart_black").fadeOut(200);
				$("#cart_message").fadeOut(200);
				$("#cart_message").empty();
			})

			$("body").on("click", ".cart_cancel", function() {
				$("#cart_black").fadeOut(200);
				$("#cart_message").fadeOut(200);
				$("#cart_message").empty();
			});

			$("body").on("click", "#cart_cont", function() {
				$("#cart_black").fadeOut(200);
				$("#cart_message").fadeOut(200);
				$("#cart_message").empty();
			});

			
						$("#product_menu_description").click(function(){
							$(this).addClass("product_active");
							$("#product_menu_features").removeClass("product_active");
							$("#product_menu_reviews").removeClass("product_active");
							$("#product_menu_overviews").removeClass("product_active");

							$("#product_features_text").hide();
							$("#product_reviews_text").hide();
							$("#product_overviews_text").hide();
							$("#product_description_text").show();
						});

						$("#product_menu_features").click(function(){
							$(this).addClass("product_active");
							$("#product_menu_description").removeClass("product_active");
							$("#product_menu_reviews").removeClass("product_active");
							$("#product_menu_overviews").removeClass("product_active");

							$("#product_description_text").hide();
							$("#product_reviews_text").hide();
							$("#product_overviews_text").hide();
							$("#product_features_text").show();
						});

						$("#product_menu_reviews").click(function(){
							$(this).addClass("product_active");
							$("#product_menu_description").removeClass("product_active");
							$("#product_menu_features").removeClass("product_active");
							$("#product_menu_overviews").removeClass("product_active");

							$("#product_description_text").hide();
							$("#product_features_text").hide();
							$("#product_overviews_text").hide();
							$("#product_reviews_text").show();
						});

						$("#product_menu_overviews").click(function(){
							$(this).addClass("product_active");
							$("#product_menu_description").removeClass("product_active");
							$("#product_menu_features").removeClass("product_active");
							$("#product_menu_reviews").removeClass("product_active");

							$("#product_description_text").hide();
							$("#product_features_text").hide();
							$("#product_reviews_text").hide();
							$("#product_overviews_text").show();
						});

						/*$("#main_image").click(function() {
							$(this).addClass("add_image_active");
							$(".add_images").removeClass("add_image_active");
							var src = $("img", this).attr("src");
							var width = $("img", this).attr("width");
							var height = $("img", this).attr("height");
							var size_kw = 350 / width;
							var size_kh = 350 / height;

								if (size_kw < size_kh) {
									size_k = size_kw;
								}
								else if (size_kw > size_kh) {
									size_k = size_kh;
								}
								else if (size_kw == size_kh) {
									size_k = size_kw;
								}

							width = width * size_k;
							height = height * size_k;


							$("#product_image img").attr("src",src);
							$("#product_image img").attr("width",width);
							$("#product_image img").attr("height",height);
						});*/

								$("#add_review_button").click(function(){
										$(this).hide();

										$("#add_review_block").fadeIn(200);
								});

					$("#cat_menu ul").hover(function(){
							$("#hide_block").removeClass("slider_block_passive");	
							$("#hide_block").addClass("slider_block_active");
							//$("#cat_header").addClass("active_header");
					},
					function(){
							$("#hide_block").removeClass("slider_block_active");	
							$("#hide_block").addClass("slider_block_passive");
							//$("#cat_header").removeClass("active_header");
					});

});