//@utf-8
$(document).on("pageinit",function(){
	TeamInfoDisAction();
})

var TeamInfoDisAction = function(){
	$("a[name='tpop']").click(function(){
		var img = new Image();
		var _this 	= 	$(this);
		var imgbig 	= 	_this.attr('attrimg');
		$(img).bind('load', function(e) {
		    $("#timg").attr("src",imgbig);
		    // $.mobile.hidePageLoadingMsg(); // Hide spinner
		    var win 	= 	parseInt(_this.attr('attrwin'));//胜场
			var los 	= 	parseInt(_this.attr('attrlos'));//负场
			var wrate 	= 	Math.round(win/(los+win)*100);//胜率
			var tnum 	= 	parseInt(_this.attr('attrnum'));//排名
			if(tnum >= 16){
				tnum = tnum - 15;
			}
			$("#win").html(win);
			$("#los").html(los);
			if (isNaN(wrate)) {wrate = 0};
			$("#wrate").html(wrate+'%');
			$("#tnum").html(tnum);
		    $("#TeamPopup").popup("open");
		});
		img.src = imgbig;
	})
}
