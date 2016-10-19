var addtagObj={
    addtagDome:function(){
        $('.addtag').click(function(e){
            e.stopPropagation();
            $(this).parents('.alert_box').siblings('.author_box').show().css({
                'border': '1px solid #5582E4'
            }).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
            $(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
            var uid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).val();
            getUserLabel(uid);

        })
    },
    
    scoreuserDom:function(){
    	$('.score_user').click(function(e){
			e.stopPropagation();
			$(this).parents(".alert_box").siblings(".author_box").show().css({
				'border': '1px solid #5582E4'
			}).parents('.user_list_bor').css('border-left', '5px solid #5582E4');
			$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(1).addClass("tag_show").siblings().removeClass("tag_show");
			var uid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).val();
			getUserScore(uid);
		});
    }
    
}

$(function() {

    addtagObj.addtagDome();
    addtagObj.scoreuserDom();


	//弹窗
	$('.check').click(function() {
		$(this).parents(".alert_box").siblings(".author_box").show().css({
			'border': '1px solid #5582E4'
		}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
		$(this).parents(".user_list_bor").siblings().css("border-left", "0").children(".author_box").hide();
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		getUserLabel(uid);

	});
	//添加选中项的边框
	$("#top_list li").click(function() {
		var index = $(this).index();
		$(this).addClass('tag_border').siblings().removeClass('tag_border').parent().siblings(".tag_list_box").children(".tag_list").eq(index).addClass("tag_show").siblings().removeClass("tag_show");

	});
	//标签hover样式
	$('.tag-nav .tag_hover1').hover(function(){
		$(this).children('.manager').show().parent('.tag_hover1').siblings().children('.manager').hide();
	},function(){
		$(this).children('.manager').hide();
	});

	//用户标签——选择标签
	$('.btn_box .tag_btn').click(function() {
		$(this).addClass("actived");
	});
	$('.btn_box .tag_btn').dblclick(function() {
		$(this).removeClass("actived");

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
	//关闭弹窗
	$(".close_btn span").click(function(){
		$(this).parents('.author_box').hide().parent('.user_list_bor').css('border-left', 'none');
        //location.reload();
        var uid = $(this).attr("uid");
        refreshLabel(uid);
        refreshUserScore(uid);
    });

	//点击空白关闭弹窗
	//$(document).click(function(){
	//	$('.author_box').hide().parent('.user_list_bor').css('border-left','none');
     //   //location.reload();
	//})
	$('.check').on("click", function(e) {
        e.stopPropagation();

    });
    $('.author_box').on("click", function(e) {
        e.stopPropagation();

    });
	//评分

	//账户部分
	$('#account_btn a.account_btn').click(function(){
		var index=$(this).index();
		$(this).addClass('active1').siblings().removeClass('active1').parents().siblings().children('#example1').eq(index).show().siblings().hide();
		var uid = $(this).val();
		getUserAccountInfo(uid);
	});

	//账户收益
	$('.pros1').click(function(){
		$(this).parents('.alert_box').siblings('.author_box').show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(6).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(6).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		getUserAccountInfo(uid);
	});
	//发布作品数
	$('.pros2').click(function(){
		$(this).parents('.alert_box').siblings('.author_box').show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(2).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(2).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		var type=1;
		getWriteList(uid,type);
	});
	//未发布作品数
	$('.pros3').click(function(){
		$(this).parents('.alert_box').siblings('.author_box').show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(3).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(3).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		var type=0;
		getWriteList(uid,type);
	});
	//收藏作品数
	$('.pros4').click(function(){
		$(this).parents('.alert_box').siblings('.author_box').show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(4).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(4).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		var type=1;
		readList(uid,type);
	});
	//读过作品数
	$('.pros5').click(function(){
		$(this).parents('.alert_box').siblings('.author_box').show().css({'border':'1px solid #5582E4'}).parent('.user_list_bor').css('border-left','5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(5).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(5).addClass("tag_show").siblings().removeClass("tag_show");
		var uid = $(this).val();
		var type =0;
		readList(uid,type);
	});
	//添加标签
	$('.addlabel').click(function(e){
		e.stopPropagation();
		$(this).parents(".alert_box").siblings(".author_box").show().css({
			'border': '1px solid #5582E4'
		}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
		var uid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).val();
		getUserLabel(uid);
	});



	//添加评分
	


	//更改用户状态
	$('.state').click(function(){
		var that = $(this);
		if(!window.confirm('确定'+that.text()+'?')){
			return false;
		}
//		alert(that.attr('s'));
		var sta = that.attr('s') == 1?0:1;
		$.ajax({
			url:'/User/del',
			data:{id:that.attr('t'),status:sta},
			success:function(data){
				//alert(that.attr('s'));
				if(that.attr('s')==1){
					that.text('已禁止');
					that.attr('s',0);
				}else{
					that.text('禁止登录');
					that.attr('s',1);
				}
			}
		})
		return false;
	});
//用户评分选中显示在选择框里
	$('.score_btn1').click(function(){//添加选中样式
		var that = $(this);
		var style = that.hasClass('cur');
		if(!style){
			that.parent().children('span').removeClass('cur');
			that.addClass('cur');
		}else{
			that.removeClass('cur');
		}
	});

	$('#sure_score').click(function(){
		var text = '';
        var ids = "";
		$('.cur').each(function(){
			text += ($(this).parent().attr('id')+' '+$(this).attr('s')+',');
            ids += ($(this).attr('a')+'_'+$(this).attr('s')+',');
		});

        if(ids.indexOf(',')>0){
            ids = ids.substr(0,ids.lastIndexOf(','));
        }
		$('.user_score').html(text);
        $('#scoreIds').val(ids);
        $('#scoreName').val(text);
//      $('.box_close').slideUp();
//      $('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
//      $('.border').addClass('collapsed-box');
        doSearch();
		return false;

	});

	$('.box_content').click(function(e){
		e.stopPropagation();
		var that=$(this);
		var style=that.parent('.border').hasClass('collapsed-box');
		if(!style){
			that.parent('.border').addClass('collapsed-box').siblings('.box_close').slideUp();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
		}else{
			that.parent('.border').removeClass('collapsed-box').siblings('.box_close').slideDown();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-plus').addClass('fa-minus');
		}
	});

	var score_search_text = '';
	$('.score_btn1').each(function(){
		var that = $(this);
		var t = that.attr('a')+'_'+that.attr('s');
		var sel = $('#scoreIds').val();
		var a = new Array();
		a = sel.split(',');

		if($.inArray(t,a)>-1){
			that.addClass('cur');
			score_search_text+=(that.parent().attr('id')+' '+that.attr('s')+',');
		}
	})
	if(score_search_text!=''){
		$('.user_score').html(score_search_text);
	}

//取消选中的分数
	$('#cancel_score').click(function(){
		$('.score_btn1').removeClass('cur');
		$('.user_score').html('&nbsp;&nbsp;用户评分');
		$('#scoreIds').val('');
		$('#scoreName').val('');
	});

//用户标签选中显示在文本框里
	$('.tag_btn').click(function(){
		var that=$(this);
		var style = that.hasClass('cur1');
		if(!style){
			that.addClass('cur1');
		}else{
			that.removeClass('cur1');
		}
	});


	$('#sure_tag').click(function(){
			var text = '';
            var ids = "";
			$('.cur1').each(function(){
				text += ($(this).attr('id')+',');
                ids += ($(this).attr('a')+',');
			});

            if(ids.indexOf(',')>0){
                ids = ids.substr(0,ids.lastIndexOf(','));
            }
			$('.user_tag').html(text);
            $('#lids').val(ids);
            $('#lidsName').val(text);
//          $('.box_close').slideUp();
//          $('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
//          $('.border').addClass('collapsed-box');
            doSearch();
			return false;
	});

	$('.tag_content').click(function(e){
		e.stopPropagation();
		var that=$(this);
		var style=that.parent('.border').hasClass('collapsed-box');
		if(!style){
			that.parent('.border').addClass('collapsed-box').siblings('.box_close').slideUp();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
		}else{
			that.parent('.border').removeClass('collapsed-box').siblings('.box_close').slideDown();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-plus').addClass('fa-minus');
		}
	});


	var tag_search_text = '';
	$('.tag_btn').each(function(){
		var that = $(this);
		var t = that.attr('a');
		var sel = $('#lids').val();
		var a = new Array();
		a = sel.split(',');

		if($.inArray(t,a)>-1){
			that.addClass('cur1');
			tag_search_text+=(that.attr('id')+',');
		}
	})
	if(tag_search_text!=''){
		$('.user_tag').html(tag_search_text);
	}


//取消选中的标签
	$('#cancel_tag').click(function(){
		$('.tag_btn').removeClass('cur1');
		$('.user_tag').html('&nbsp;&nbsp;标签');
		$('#lids').val('');
		$('#lidsName').val('');
	})


//显示全部
$('.showAll').click(function(){
	var that = $(this);
	var text = that.text();
	if(text=='显示全部'){
	   that.text('收起').parent().children('li').show();
	}else{
		that.parent().children('li:gt(2)').hide();
		that.parent().children('li:last').prev().show();
		that.parent().children('li:last').show().text('显示全部');

	}
});

});

