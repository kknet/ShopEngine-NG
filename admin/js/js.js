$(document).ready(function(){
	if (!$("#main_menu li").hasClass("active")) {
		$(".notice", this).css("color","#000");
	}	

		$("#logout").click(function(){
			$.ajax({
				type: 'POST',
				url: 'functions/logout.php',
				dataType: 'html',
				cache: false,
				success: function(data) {
					if(data == 'logout') {
						window.location.reload();
					}
				}
			});
		});

		var count_feat = 1;
			$(".product_add_features").click(function(){
				next_count_feat = count_feat + 1;
					$("#product_features"+count_feat).after('<br/><input type="text" class="product_features" id="product_features'+next_count_feat+'" name="product_features'+next_count_feat+'" placeholder="Поле ввода '+next_count_feat+'"/>');
				count_feat++;
				if (count_feat == 10) {
					$(".product_add_features").hide();
				}
		});

		var count_feat_big = 1;
			$(".product_add_features_big").click(function(){
				next_count_big = count_feat_big + 1;
					$("#editor_mini"+count_feat_big).after('<br/><label for="product_big_features_title'+next_count_big+'">Заголовок '+next_count_big+'</label><br/><input class="product_big_features_title" type="text" id="product_big_features_title'+next_count_big+'" name="product_big_features_title'+next_count_big+'" /><br/><br/><label for="product_big_features_text'+next_count_big+'">Текст '+next_count_big+'</label><br/><div class="editor_mini" id="editor_mini'+next_count_big+'"><textarea id="product_big_features_text'+next_count_big+'" name="product_big_features_text'+next_count_big+'"></textarea><br/><br/></div>');
				count_feat_big++;
				if (count_feat_big == 11) {
					$(".product_add_features_big").hide();
				}
		});	

		var count_image = $(".image_box").length;	
		if (count_image >= 5) {
					$(".product_add_images").hide();
					$(".add_image").hide();
				}
		if (count_image < 1) {
			count_image = 1;
		}
			$(".product_add_images").click(function(){
				count_image_next = count_image + 1;
					$("#add_image1").after('<br/><input type="file" class="add_image" id="add_image'+count_image_next+'" name="add_image[]" />');
				count_image++;
				if (count_image >= 5) {
					$(".product_add_images").hide();
				}
			});

				$("#sale").change(function(){
						if ($("#sale").prop("checked") == true) {
							$("#old_price").removeAttr("disabled");
						}
						if ($("#sale").prop("checked") == false) {
							$("#old_price").attr("disabled","");
						}
				});

						$("#product_cat").change(function(){
								cat = $(this).val();
								$.ajax({
									type:'POST',
									url:'functions/categoryloader.php',
									data:{'cat':cat},
									dataType:'html',
									cache:false,
									success: function(data) {
										$("#product_subcat").html(data);
									}				
							});
						});

						/*

						$("#add_product_button").click(function(){
							var error = 0;

							var category = $("#product_cat").val();
							var subcat = $("#product_subcat").val();
							var brand = $("#product_brand").val();
							var title = $("#product_title").val();

							var feat1 = $("#product_features1").val();
							var feat2 = $("#product_features2").val();
							var feat3 = $("#product_features3").val();
							var feat4 = $("#product_features4").val();
							var feat5 = $("#product_features5").val();
							var feat6 = $("#product_features6").val();
							var feat7 = $("#product_features7").val();
							var feat8 = $("#product_features8").val();
							var feat9 = $("#product_features9").val();
							var feat10 = $("#product_features10").val();

							var description = $("#editor1").val();

							var feat_header1 = $("#product_big_features_title1").val();
							var feat_header2 = $("#product_big_features_title2").val();
							var feat_header3 = $("#product_big_features_title3").val();
							var feat_header4 = $("#product_big_features_title4").val();
							var feat_header5 = $("#product_big_features_title5").val();
							var feat_header6 = $("#product_big_features_title6").val();
							var feat_header7 = $("#product_big_features_title7").val();
							var feat_header8 = $("#product_big_features_title8").val();
							var feat_header9 = $("#product_big_features_title9").val();
							var feat_header10 = $("#product_big_features_title10").val();
							var feat_header11 = $("#product_big_features_title11").val();

							var feat_text1 = $("#product_big_features_text1").val();
							var feat_text2 = $("#product_big_features_text2").val();
							var feat_text3 = $("#product_big_features_text3").val();
							var feat_text4 = $("#product_big_features_text4").val();
							var feat_text5 = $("#product_big_features_text5").val();
							var feat_text6 = $("#product_big_features_text6").val();
							var feat_text7 = $("#product_big_features_text7").val();
							var feat_text8 = $("#product_big_features_text8").val();
							var feat_text9 = $("#product_big_features_text9").val();
							var feat_text10 = $("#product_big_features_text10").val();
							var feat_text11 = $("#product_big_features_text11").val();

							var old_price = $("#old_price").val();
							var price = $("#price").val();

							if (category !== "" && subcat !== "" && brand !== "" && title !== "" && feat1 !== "" && description !== "" && feat_header1 !== "" && feat_text1 !== "") {
								
									error = 0;

								if($("#sale").prop("checked") === true) {
									if (old_price !== "") {
										error = 0;
									}
									else {
										error = 1;
									}
								}
								else {
									error = 0;
								}
							}
							else {
								error = 1;
							}

							if (error == 0) {

								if($("#sale").prop("checked") === true) {
									var sale = '1';
								}
								else {
									var sale = '0';
								}
								if($("#visible").prop("checked") === true) {
									var visible = '1';
								}
								else {
									var visible = '0';
								}
								if($("#available").prop("checked") === true) {
									var available = '1';
								}
								else {
									var available = '0';
								}
								if($("#news").prop("checked") === true) {
									var news = '1';
								}
								else {
									var news = '0';
								}
								if($("#popular").prop("checked") === true) {
									var popular = '1';
								}
								else {
									var popular = '0';
								}

								$.ajax ({
											type:'POST',
											url:'functions/add_product.php',
											data:{'cat':category,'subcat':subcat,'brand':brand,'title':title,'feat1':feat1,'feat2':feat2,'feat3':feat3,'feat4':feat4,'feat5':feat5,'feat6':feat6,'feat7':feat7,'feat8':feat8,'feat9':feat9,'feat10':feat10,'description':description,'feat_header1':feat_header1,'feat_header2':feat_header2,'feat_header3':feat_header3,'feat_header4':feat_header4,'feat_header5':feat_header5,'feat_header6':feat_header6,'feat_header7':feat_header7,'feat_header8':feat_header8,'feat_header9':feat_header9,'feat_header10':feat_header10,'feat_header11':feat_header11,'feat_text1':feat_text1,'feat_text2':feat_text2,'feat_text3':feat_text3,'feat_text4':feat_text4,'feat_text5':feat_text5,'feat_text6':feat_text6,'feat_text7':feat_text7,'feat_text8':feat_text8,'feat_text9':feat_text9,'feat_text10':feat_text10,'feat_text11':feat_text11,'old_price':old_price,'price':price,'sale':sale,'visible':visible,'available':available,'news':news,'popular':popular},
											dataType:'html',
											cache:false,
											beforeSend: function() {
												$('#pre_loading').fadeIn(50);
											},
											success: function(data) {
												if (data == 'false') {
												 	alert("Произошла ошибка. Проверьте правильность введенных данных.")
												}
												else {
													var id = data;
													var fd = new FormData();
													fd.append('id',id);
													fd.append('img', $('#imgFile')[0].files[0]);

													$.ajax({
														type:'POST',
														url:'functions/add_product_main_image.php',
														data:{'img':uploadimage},
														cache:false,
														success: function(data) {
															var img1 = $("#add_image1").val();
															var img2 = $("#add_image2").val();
															var img3 = $("#add_image3").val();
															var img4 = $("#add_image4").val();
															var img5 = $("#add_image5").val();
															var img6 = $("#add_image6").val();
															$.ajax({
																type:'POST',
																url:'functions/add_product_add_image.php',
																data:{'img1':img1,'img2':img2,'img3':img3,'img4':img4,'img5':img5,'img6':img6},
																cache:false,
																success: function() {
																	$('#pre_loading').fadeOut(50);	
																	window.reload();
																}
															});
														}
													});
												}
											}
										});
							}
							else {
								return false;
							}

						});
						*/

							$("#product_add_cat").click(function(){
								$(".black").fadeIn(200);
								$("#add_category").fadeIn(200);
							});

							$(".add_category_cancel").click(function(){
								$(".black").fadeOut(200);
								$("#add_category").fadeOut(200);
							})
							$(".black").click(function(){
								$(".black").fadeOut(200);
								$("#add_category").fadeOut(200);
							});

							$("#add_category_button").click(function(){
								var cat_name = $("#add_category_input").val();

								if(cat_name != "") {
									$.ajax({
										type:'POST',
										url:'functions/new_cat.php',
										data:{'cat_name':cat_name},
										dataType:'html',
										cache:false,
										success: function(data) {
											if (data == 'true') {
												window.location.reload();
											}
											else {
												alert("Ошибка. Повторите попытку.");
											}
										}
									});
								}
								else {
									alert("Пустой запрос");
								}
							});

							$("#product_add_subcat").click(function(){
								$(".black").fadeIn(200);
								$("#add_subcategory").fadeIn(200);
							});

							$(".add_category_cancel").click(function(){
								$(".black").fadeOut(200);
								$("#add_subcategory").fadeOut(200);
							})
							$(".black").click(function(){
								$(".black").fadeOut(200);
								$("#add_subcategory").fadeOut(200);
							});

								$("#add_subcategory_button").click(function(){
										var cat = $("#select_cat").val();
										var subcat = $("#add_subcategory_input").val();
										if (cat != "" && subcat != "") {
											$.ajax({
												type:'POST',
												url:'functions/new_subcat.php',
												data:{'cat_name':cat,'subcat':subcat},
												dataType:'html',
												cache:false,
												success: function(data) {
													if (data == 'true') {
														window.location.reload();
												}
													else {
														alert("Ошибка. Повторите попытку.");
												}
											}
										});
									}
									else {
										alert("Оба поля должны быть заполнены");
									}
								});

							$("#product_add_brand").click(function(){
								$(".black").fadeIn(200);
								$("#add_brand").fadeIn(200);
							});

							$(".add_category_cancel").click(function(){
								$(".black").fadeOut(200);
								$("#add_brand").fadeOut(200);
							})
							$(".black").click(function(){
								$(".black").fadeOut(200);
								$("#add_brand").fadeOut(200);
							});

							$("#add_brand_button").click(function(){
								var brand_name = $("#add_brand_input").val();

								if(brand_name != "") {
									$.ajax({
										type:'POST',
										url:'functions/new_brand.php',
										data:{'brand_name':brand_name},
										dataType:'html',
										cache:false,
										success: function(data) {
											if (data == 'true') {
												window.location.reload();
											}
											else {
												alert("Ошибка. Повторите попытку.");
											}
										}
									});
								}
								else {
									alert("Пустой запрос");
								}
							});

							$("#product_cat").change(function() {
									$("#delete_cat").show();
							});
							$("#product_subcat").change(function() {
									$("#delete_subcat").show();
							});
							$("#product_brand").change(function() {
									$("#delete_brand").show();
							});

							$("#delete_cat").click(function(){
									var isdelete = confirm("Это действие повлечет за собой удаление всех подкатегорий и товаров, пренадлежащих им. Вы хотите продолжить?");
									if(isdelete === true) {
										var del = $("#product_cat").val();
										$.ajax({
												type:'POST',
												url:'functions/delete_cat.php',
												data:{'del':del},
												dataType:'html',
												cache:false,
												success: function(data) {
													if(data == 'true') {
														window.location.reload();
													}
													else {
														alert("Ошибка");
													}
												}
										})
									}
							});

							$("#delete_subcat").click(function(){
									var isdelete = confirm("Это действие повлечет за собой удаление всех товаров, пренадлежащих этим категориям. Вы хотите продолжить?");
									if(isdelete === true) {
										var del = $("#product_cat").val();
										var sub = $("#product_subcat").val();
										$.ajax({
												type:'POST',
												url:'functions/delete_subcat.php',
												data:{'del':del,'sub':sub},
												dataType:'html',
												cache:false,
												success: function(data) {
													if(data == 'true') {
														window.location.reload();
													}
													else {
														alert("Ошибка");
													}
												}
										})
									}
							});

								$("#delete_brand").click(function(){
									var isdelete = confirm("Вы действительно хотите удалить производителя?");
									if(isdelete === true) {
										var del = $("#product_brand").val();
										$.ajax({
												type:'POST',
												url:'functions/delete_brand.php',
												data:{'del':del},
												dataType:'html',
												cache:false,
												success: function(data) {
													if(data == 'true') {
														window.location.reload();
													}
													else {
														alert("Ошибка");
													}
												}
										})
									}
							});

										$(".product_delete").click(function(){
											var id = $(this).attr("id");
											var isdelete = confirm("Вы действительно хотите удалить товар?");
											if(isdelete === true) {
											$.ajax({
													type:'POST',
													url:'functions/delete_product.php',
													data:{'id':id},
													dataType:'html',
													cache:false,
													success:function(data) {
														if(data == 'true') {
														window.location.reload();
													}
													else {
														alert(data);
													}
												}
											});
										}
									});

						var count = $("#slider_images li").length;
						$("#add_slide").click(function(){
							new_count = count + 1;
							$("#slider_images").append('<li type="dynamic" id="'+new_count+'"><div class="slider_image"><input type="file" name="slider_img_add[]" id="slider_img'+new_count+'" /></div><label class="label_title" for="slider_title'+new_count+'">Подпись</label><input type="text" id="slider_title'+new_count+'" name="slider_title_add[]" class="slider_title" value=""/><br/><label class="label_link"for="slider_link'+new_count+'">Ссылка</label><input type="text" id="slider_link'+new_count+'" name="slider_link_add[]" class="slider_link"/></li>');
							count++;	
						});		

									$("#slider_apply").click(function(e){
											e.preventDefault();

											var countofslides = $(".static").length;
											var i = 1;
											for(i=1;i<=countofslides;i++) {
														var id = $("li#"+i).attr("slide_id");
														var title = $("li#"+i+" .slider_title").val();
														var link = $("li#"+i+" .slider_link").val();
														$.ajax({
																type:'POST',
																url:'functions/add2slider.php',
																data:{'id':id,'title':title,'link':link},
																dataType: 'html',
																cache:false,
													});
												}
												window.location.reload();
									   		});

									$(".admin_delete").click(function(){
										var id = $(this).attr("aid");
										var isdelete = confirm("Вы действительно хотите удалить этого администратора?");
										if(isdelete === true) {
										$.ajax({
												type:'POST',
												url:'functions/delete_admin.php',
												data:{'id':id},
												dataType:'html',
												cache:false,
												success:function() {
													window.location.reload();
												}
										});
									}
								});


										$(".user_delete").click(function(){
										var id = $(this).attr("aid");
										var isdelete = confirm("Вы действительно хотите удалить этого пользователя?");
										if(isdelete === true) {
										$.ajax({
												type:'POST',
												url:'functions/delete_user.php',
												data:{'id':id},
												dataType:'html',
												cache:false,
												success:function(data) {
													window.location.reload();
												}
										});
									}
								});


								$("#article_delete").click(function(e){
										e.preventDefault();
										var id = $(this).attr("aid");
										var isdelete = confirm("Вы действительно хотите удалить эту статью?");
										if(isdelete === true) {
										$.ajax({
												type:'POST',
												url:'functions/delete_article.php',
												data:{'id':id},
												dataType:'html',
												cache:false,
												success:function() {
													window.location.replace('articles.php')
												}
										});
									}
								});

								$(".change_block_title").click(function(){
									var id = $(this).attr("aid");
									$(this).hide();
									$("#"+id).show();
									$(".save_block_title").show();
								});

								$(".save_block_title").click(function(){
									var id = $(this).attr("aid");
									var title = $("#"+id).val();
									if(title != "") {
										$.ajax({
											type:'POST',
											url:'functions/change_block_title.php',
											data:{'title':title,'id':id},
											dataType:'html',
											cache:false,
											success:function(data) {
												window.location.reload();
											}
										});
									}
								});

									$(".apply_template").click(function(){
										var id = $(this).attr("id");
										$.ajax({
											type:'POST',
											url:'functions/apply_template.php',
											data:{'id':id},
											dataType:'html',
											cache:false,
											success:function(data) {
												alert(data);
												window.location.reload();
											}
										});
									});

									$(".delete_template").click(function(){
										var id = $(this).attr("id");
										var isdelete = confirm("Вы действительно хотите удалить тему? Отменить данное действие будет невозможно.");
										if (isdelete === true) {
										$.ajax({
											type:'POST',
											url:'functions/delete_template.php',
											data:{'id':id},
											dataType:'html',
											cache:false,
											success:function(data) {
												alert(data);
												window.location.reload();
											}
										});
									}
								});	

									$("#new_template").click(function(){
										$("#new_template_div").show();
										$("#new_template").hide();
									});

});