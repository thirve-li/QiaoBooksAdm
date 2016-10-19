var indexObj = {
	getFlg:false,
	host: "/",
	chart:function(canvasObj,opt){
		canvasObj.setOption(opt);
		canvasObj.on('mousemove', function (params) {
			if(params.seriesIndex==0){
      			opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(85,130,228,1)';
    			opt.series[params.seriesIndex].itemStyle.normal.color='rgba(85,130,228,1)';
	      	}else if(params.seriesIndex==1){
	      		opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(0,192,239,1)';
	    		opt.series[params.seriesIndex].itemStyle.normal.color='rgba(0,192,239,1)';
	      	}else{
	      		opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(96,90,170,1)';
	    		opt.series[params.seriesIndex].itemStyle.normal.color='rgba(96,90,170,1)';
	      	}
	    	opt.series[params.seriesIndex].itemStyle.normal.lineStyle.width =5;	
	    	opt.series[params.seriesIndex].symbolSize =12;
	    	canvasObj.setOption(opt);
		});
		canvasObj.on('mouseout', function (params) {
	 		if(params.seriesIndex==0){
      		opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(85,130,228,0.3)';
    		opt.series[params.seriesIndex].itemStyle.normal.color='rgba(85,130,228,0.3)';
      	}else if(params.seriesIndex==1){
      		opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(0,192,239,0.3)';
    		opt.series[params.seriesIndex].itemStyle.normal.color='rgba(0,192,239,0.3)';
      	}else{
      		opt.series[params.seriesIndex].itemStyle.normal.lineStyle.color ='rgba(96,90,170,0.3)';
    		opt.series[params.seriesIndex].itemStyle.normal.color='rgba(96,90,170,0.3)';
      	}
    	opt.series[params.seriesIndex].itemStyle.normal.lineStyle.width =3;
    	opt.series[params.seriesIndex].symbolSize =10;
    	
    	canvasObj.setOption(opt);
	});
	canvasObj.on('legendselectchanged', function (params) {
			for(var i=0;i<opt.series.length;i++){
				if(params.name==opt.series[i].name==true){
					if(i==0){
		      			colors = 'rgba(85,130,228,1)';
		      		}else if(i==1){
		      			colors = 'rgba(0,192,239,1)';
		      		}else if(i==2){
		      		colors = 'rgba(96,90,170,1)';
		      	}
		      	opt.series[i].itemStyle.normal.lineStyle.color=opt.series[i].itemStyle.normal.color=colors;
		      	opt.series[i].itemStyle.normal.lineStyle.width =5;	
    			opt.series[i].symbolSize =12;
				}else{
					if(i==0){
			      		colors = 'rgba(85,130,228,0.3)';
			      	}else if(i==1){
			      		colors = 'rgba(0,192,239,0.3)';
			      	}else if(i==2){
			      		colors = 'rgba(96,90,170,0.3)';
			      	}
			      	opt.series[i].itemStyle.normal.lineStyle.color=opt.series[i].itemStyle.normal.color=colors;
			      	opt.series[i].itemStyle.normal.lineStyle.width =3;	
	    			opt.series[i].symbolSize =10;
				}
			}
			canvasObj.setOption(opt);
		});
	}
}
