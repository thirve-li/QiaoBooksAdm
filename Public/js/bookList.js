var addtagObj={
    addtagDome:function(){
        $('.addtag').click(function(e){
			e.stopPropagation();
			$(this).parents('.alert_box').siblings('.author_box').show().css({
				'border': '1px solid #5582E4'
			}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
			$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
			var bid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).val();
			getBookLabel(bid);
		});
    },
    addscoreDom:function(){
    	$('.add_score').click(function(e){
			e.stopPropagation();
			$(this).parents('.alert_box').siblings('.author_box').show().css({
				'border': '1px solid #5582E4'
			}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
			$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(1).addClass("tag_show").siblings().removeClass("tag_show");
			var bid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).val();
			getBookScore(bid);
		});
    }
}
function showDetail(bid){
	$("#showDetail_"+bid).parents(".alert_box").siblings(".author_box").show().css({
			'border': '1px solid #5582E4'
	}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
	
	$("#showDetail_"+bid).parents(".user_list_bor").siblings().css("border-left", "0").children(".author_box").hide();
	$("#showDetail_"+bid).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
	getBookLabel(bid);
}
$(function(){
	
	$("#top_list li").click(function(){
		var index=$(this).index();
		$(this).addClass('tag_border').siblings().removeClass('tag_border').parent().siblings(".tag_list_box").children(".tag_list").eq(index).addClass("tag_show").siblings().removeClass("tag_show");
	});
//点击空白部分，弹框隐藏	
//	$(document).click(function(){
//		$('.author_box').hide().parent('.user_list_bor').css('border-left','none');
//	})
	$('.details').on("click", function(e) {
        e.stopPropagation();
    });
    $('.author_box').on("click", function(e) {
        e.stopPropagation();
    });
//   
	$('.close_btn span').click(function(){
		$(this).parents('.author_box').hide().parent('.user_list_bor').css('border-left','none');
//      var bid = $(this).attr("bid");
        
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
	
//添加标签
	$('.add_label').click(function(e){
		e.stopPropagation();
		$(this).parents('.alert_box').siblings('.author_box').show().css({
			'border': '1px solid #5582E4'
		}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
		var bid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).val();
		getBookLabel(bid);
	
	});
	
	$('.addtag').click(function(e){
		e.stopPropagation();
		$(this).parents('.alert_box').siblings('.author_box').show().css({
			'border': '1px solid #5582E4'
		}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(0).addClass("tag_show").siblings().removeClass("tag_show");
		var bid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(0).val();
		getBookLabel(bid);
	})
	
//添加评分
	$('.add_score').click(function(e){
		e.stopPropagation();
		$(this).parents('.alert_box').siblings('.author_box').show().css({
			'border': '1px solid #5582E4'
		}).parent('.user_list_bor').css('border-left', '5px solid #5582E4');
		$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).addClass("tag_border").siblings().removeClass("tag_border").parent().siblings(".tag_list_box").children(".tag_list").eq(1).addClass("tag_show").siblings().removeClass("tag_show");
		var bid=$(this).parents(".alert_box").siblings(".author_box").children("#top_list").children("li").eq(1).val();
		getBookScore(bid);
	
	});
	
//账户部分
	$('#account_btn a').click(function(){
		var index=$(this).index();
		$(this).addClass('active1').siblings().removeClass('active1').parents().siblings().children('#example1').eq(index).show().siblings().hide();
	});
	
//修改书名(书名限制16个字符)
	$('.detail_change').click(function(){
		var  te=$(this).text();
		if(te=="修改书名"){
			$(this).text('确定');
				var name = $(this).siblings('.author_name');
				var txt=name.text();

                var bid=$(this).attr("bid");

				name.text("").append('<input id="bookName_'+bid+'" type="text" value='+txt+' />').children('input').css('width','144px').change(function(){
					 var curLength=$(this).val().length;
					   if(curLength>=16) {
					        var num=$(this).val().substr(0,16);
					        $(this).val(num);
					        alert("超过字数限制，多出的字将被截断！" );
					       vla=$(this).val();
					   }

					   
                  });
		}

        if(te=="确定"){
             editBookName(this);
        }
		
	});
	

//标签hover样式
	$('.tag-nav .tag_hover').hover(function(){
		$(this).children('.manager').show().parent('.tag_hover').siblings().children('.manager').hide();
	},function(){
		$(this).children('.manager').hide();
	});
//标签限制显示条数

//价格hover效果
	$('.price_tip').hover(function(){
		var that = $(this);
		var li_html = that.next('.p_price').children('ul').children("li");
		if(li_html.length!=0){
			that.next('.p_price').show();
		} else {
			that.next('.p_price').hide();
		}

},function(){
	$(this).next('.p_price').hide();
});
	
//更改上下架状态
	$('.isup').click(function(){
		var that = $(this);
		if(!window.confirm('确定'+that.text()+'?')){
			return false;
		}
//		alert(that.attr('s'));
		var sta = that.attr('s') == 1?0:1;
		$.ajax({
			url:'/Book/del',
			data:{id:that.attr('t'),status:sta},
			success:function(data){		
//				alert(that.attr('s'));
                if(data>0){
                    alert(that.text()+"成功！");
                    if(that.attr('s')==1){
                        that.text('上架');
                        that.attr('s',1);
                    }else{
                        that.text('下架');
                        that.attr('s',0);
                    }
                }
			}
		})
		return false;
	});
		
//作品评分选中显示在选择框里	
	$('.score_btn3').click(function(){
		var that = $(this);
		var style = that.hasClass('cur');
		if(!style){
			that.parent().children('span').removeClass('cur');
			that.addClass('cur');
		}else{
			that.removeClass('cur');
		}
		
	})
	
	$('#sure_score').click(function(){
		var text = '';
		var ids = "";
		$('.cur').each(function(){
			text += ($(this).parent().attr('id')+$(this).attr('s')+',');
			ids += ($(this).attr('a')+'_'+$(this).attr('s')+',');
		})
//		alert(text);
		if(ids.indexOf(',')>0){
            ids = ids.substr(0,ids.lastIndexOf(','));
        }
		$('.work_score').html(text);
		$('#scoreIds').val(ids);
		$('#scoreName').val(text);
		doSearch();
		return false;
		
	});
	
	$('.box_content').click(function(e){
		e.stopPropagation();
		var that=$(this);
		var style=that.parent('.dropdown_input').hasClass('collapsed-box');
		if(!style){
			that.parent('.dropdown_input').addClass('collapsed-box').siblings('.box_close').slideUp();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
		}else{
			that.parent('.dropdown_input').removeClass('collapsed-box').siblings('.box_close').slideDown();
			that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-plus').addClass('fa-minus');
		}
	});
	
	var score_search_text = '';
	$('.score_btn3').each(function(){
		var that = $(this);
		var t = that.attr('a')+'_'+that.attr('s');
		var sel = $('#scoreIds').val();
		var a = new Array();
		a = sel.split(',');

		if($.inArray(t,a)>-1){
			that.addClass('cur');
			score_search_text+=(that.parent().attr('id')+that.attr('s')+',');
		}
	})
	if(score_search_text!=''){
		$('.work_score').html(score_search_text);
	}
	
	//取消选中的分数		
	$('#cancel_score').click(function(){
		$('.score_btn3').removeClass('cur');
		$('.work_score').html('&nbsp;&nbsp;作品评分');
		$('#scoreIds').val('');
		$('#scoreName').val('');
	});


//作品标签选中显示在文本框里
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
			})
			if(ids.indexOf(',')>0){
                ids = ids.substr(0,ids.lastIndexOf(','));
            }
			$('.workTag').html(text);
			$('#lids').val(ids);
			$('#lidsName').val(text);
//			$('.box_close').slideUp();
//			$('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
//			$('.dropdown_input').addClass('collapsed-box');
			doSearch();
			return false;
			
		});	
	
	//$('.tag_content').click(function(e){
	//	e.stopPropagation();
	//	var that=$(this);
	//	var style=that.parent('.dropdown_input').hasClass('collapsed-box');
	//	if(!style){
	//		that.parent('.dropdown_input').addClass('collapsed-box').siblings('.box_close').slideUp();
	//		that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-minus').addClass('fa-plus');
	//	}else{
	//		that.parent('.dropdown_input').removeClass('collapsed-box').siblings('.box_close').slideDown();
	//		that.children('.box-tools').children('.btn-box-tool').children('i').removeClass('fa-plus').addClass('fa-minus');
	//	}
	//});
		
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
		$('.workTag').html(tag_search_text);
	}
	
	
//取消选中的标签	
	$('#cancel_tag').click(function(){
		$('.tag_btn').removeClass('cur1');
		$('.workTag').html('&nbsp;&nbsp;标签');
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
