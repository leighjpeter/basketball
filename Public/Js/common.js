//set names utf-8;
//定义一个js里面可以用的__root__
/*document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
})*/
$( document ).on( "click", ".show-page-loading-msg", function() {
    var $this = $( this ),
        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
        textonly = !!$this.jqmData( "textonly" );
        html = $this.jqmData( "html" ) || "";
    $.mobile.loading( "show", {
            text: msgText,
            textVisible: textVisible,
            theme: theme,
            textonly: textonly,
            html: html
    });
})
.on( "click", ".hide-page-loading-msg", function() {
    $.mobile.loading( "hide" );
});
/**
 * U方法
 * @param param 项目名称/action名称/function名称
 * @param suffix 伪后缀名
 * @param root_url 项目rooturl默认为defined.js里面设置的IpUrl
 */
function U(){
	var param = arguments[0] ? arguments[0] : "";
	var root_url = arguments[1] ? arguments[1] : IpUrl;
	//var suffix = arguments[2] ? arguments[2] : "xml";
	//var return_url = root_url + "/" + param + "." + suffix;
	//var time_stamp = Date.parse(new Date());
	//return_url = return_url + "?" + time_stamp;
	return_url = root_url + "/" + param;
	return return_url;
}