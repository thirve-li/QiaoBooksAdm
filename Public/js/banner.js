$(function() {
	var Uid =1; //$("#sortable2").children("li").length;
	$("#bannerBox").click(function() {
		var b = $(this);
		if(b.hasClass("bannerBox")) {
			b.removeClass("bannerBox");
			Uid++;
			var html = "";
			html += "<li class='col-md-4'>";
			html += "<dl>";
			html += "<dt><p>第" + Uid + "张</p></dt>";
			html += "<dt id='imgUrl_" + Uid + "'><img src='../img/bg_news.png'/><input type='file'/></dt>";
			html += "<dt><span>发布时间：</span><input type='datetime-local'/></dt>";
			html += "<dt><span>标题：</span><input type='text' placeholder='输入标题'/></dt>";
			html += "<dt><span>链接：</span><input type='url' placeholder='输入链接'/></dt>";
			html += "<dt><button type='button' class='quxiao'>取消</button><button type='button' class='queding'>确定</button></dt>";
			html += "<dt class='uses'><span>操作：</span><a href='javaScript:va();' class='quxiao'>删除</a></dt>";
			html += "</dl>";
			html += "</li>";
			$("#sortable2").append(html);

			//添加完成再执行拖动
			$(".drag_box").children('li').click(function() {
				var type = $(this).attr("type");
				if(type == "drag") {
					sortable();
				}
			});
			

			//添加图片
			$('[type=file]').change(function(e) {
					var file = e.target.files[0]
					preview1(file, Uid);
				})
				//点击确定添加内容
			$(".queding").click(function() {
				var liVal = $(this).parents("li").children("dl").children('dt');
				
				//获取input里面的值
				for(var i = 0; i < liVal.length; i++) {
					var val = liVal.eq(i).children("input").val();
					if(val == "" || val == undefined) {} else {
						b.addClass("bannerBox");
						liVal.eq(i).children("input").remove().siblings("span").css("float", "none");
						liVal.eq(i).append(val).children("input").remove();
						$(this).parent("dt").remove();
					}
				}
				$(this).parents("li").attr("type", "drag"); //添加属性  是否可以拖动
			});

			//点击取消添加
			$(".quxiao").click(function() {
				$(this).parents("li").remove();
				b.addClass("bannerBox");
				Uid -= 1;
			});

			$(".drag_box li").click(function() {
				sortable();
			});
		}

	});

	//banner 拖动2
	$(".drag_box li").click(function() {
		var type = $(this).attr("type");
		if(type == "drag") {
			sortable();
		}
	});

});

//删除banner弹窗
function openBox() {
	var html = "";
	html += "<div class='open'>";
	html += "<div class='delete'>";
	html += "<span>删除Banner</span>";
	html += "<p>你确定要删除这个Banner吗？</p>";
	html += "<div class='btn'>";
	html += "<button type='button' class='btn_lefts'>取消</button>";
	html += "<button type='button' class='btn_lefts'>删除</button>";
	html += "</div>";
	html += "</div>";

	$("#banner_cont").append(html);

	$(".btn_right").click(function() {
		$(this).parents(".open").hide();
	});
}

//页面加载时拖动事件
function sortable() {
	$('#sortable2, #sortable3').sortable({
		connectWith: '.connected'
	});
}

//添加图片
function preview1(file, Uid) {
	var img = new Image(),
		url = img.src = URL.createObjectURL(file)
	var $img = $(img)
	img.onload = function() {
		URL.revokeObjectURL(url)
		$('#imgUrl_' + Uid).empty().append("<div class='imgboxs'><img src='../img/bg_news.png'/><div class='newsimgbox' id='newsimgbox_" + Uid + "'></div></div>")
		$('#newsimgbox_' + Uid).append($img);
	}
}