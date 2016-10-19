$(function(){
	$('.check').click(function(){
		$(this).parents(".alert_box").siblings(".author_box").show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4').siblings(".user_list_bor").children(".author_box").hide();
	});
	$("#top_list li").click(function(){
		var index=$(this).index();
		$(this).addClass('tag_border').siblings().removeClass('tag_border').parent().siblings(".tag_list_box").children(".tag_list").eq(index).addClass("tag_show").siblings().removeClass("tag_show");
	});
	$('.close_btn span').click(function(){
		$(this).parents('.author_box').hide().parent('.user_list_bor').css('border-left','none');
	});
//用户标签——选择标签	
	$('.btn_box .tag_btn').click(function(){
		$(this).addClass("actived");
	});
	$('.btn_box .tag_btn').dblclick(function(){
		$(this).removeClass("actived");
		
	});
	
		
//提交按钮
	$(".sbt").click(function(){
		for (var i=0;i<$(".btnType span").length;i++) {
			alert($(".btnType span").eq(0).text())
		}
	});

//用户评分——我的评分
	$(".progress_score .fraction span").click(function(){
		var i=$(this).text();
		$(this).parent(".fraction").append("<input type='text' value="+i+"/>");
		$(this).remove();//移除属性
	});
	$(".progress_score .fraction").dblclick(function(){
		var txt=$(this).text();
		$(this).text("").append("<input type='text' value="+txt+" />").children("input").change(function(){
			var t=$(this).val();
			$(this).parent().text(t).remove("input");
		});
	});
//账户部分
	$('#account_btn a').click(function(){
		var index=$(this).index();
		$(this).addClass('active1').siblings().removeClass('active1').parents().siblings().children('#example1').eq(index).show().siblings().hide();
	});	
//修改书名
	$('.details').click(function(){
		$(this).siblings('.author_name').change(function(){
			var txt=$(this).text();
			$(this).text("").append("<input type='text' value="+txt+" />").children('input').change(function(){
				var t=$(this).val();
				$(this).parent().text(t).remove("input");
			});
		});
	});
//标签hover样式
	$('.tag-nav .tag_hover').hover(function(){
		$(this).children('.manager').show().parent('.tag_hover').siblings().children('.manager').hide();
	},function(){
		$(this).children('.manager').hide();
	});
//价格点击效果
	$('.price_tip').click(function(){
		$(this).siblings('.p_price').show();
	},function(){
		$(this).siblings('.p_price').hide();
	});
	
});
