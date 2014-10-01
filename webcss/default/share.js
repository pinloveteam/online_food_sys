/* versionbeta:name
 * versionbeta:number
 * versionbeta:site
 * versionbeta:pubtime
 */
var share = new function() {
	this.to = function( o ) {
		switch(o.type) {
			case "qzone":
				this.qzone( o );
				break;
			case "qqweibo":
				this.qqweibo( o );
				break;
			case "sina":
				this.sina( o );
				break;
			case "renren":
				this.renren( o );
				break;
			case "kaixin":
				this.kaixin( o );
				break;
			case "douban":
				this.douban( o );
				break;
			default:
				kj.copy(o.cont+o.url);

		}
	}
	this.qqweibo = function( o ){
		var _pic = o.pic;//encodeURI('http://i559mini.act.qq.com/images/img_1992heping1.jpg');//（例如：var _pic='图片url1|图片url2|图片url3....）
		var _t = encodeURI(o.cont);
		var _url = encodeURIComponent(o.url);
		var _site = '';//你的网站地址
		var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey=&site='+_site+'&pic='+_pic+'&title='+_t;
		window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
	}
	this.qzone = function( o ){
		var _desc = encodeURIComponent(o.cont);
		var _url = encodeURIComponent(o.url);
		var url = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+_url+'&desc='+_desc+"&title="+encodeURIComponent(o.title)+"&site=&summary="+""+"&pics="+o.pic;
		window.open(url,"_blank");	
	}
	this.sina = function( o ){
		var _w = 72 , _h = 16;
		var param = {
			url:o.url,
			type:'3',
			count:'1', /**是否显示分享数，1显示(可选)*/
			appkey:'', /**您申请的应用appkey,显示分享来源(可选)*/
			title:o.cont, /**分享的文字内容(可选，默认为所在页面的title)*/
			pic:o.pic, /**分享图片的路径(可选)*/
			ralateUid:'', /**关联用户的UID，分享微博会@该用户(可选)*/
			rnd:new Date().valueOf()
		}
		var temp = [];
		for( var p in param ){
			temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
		}
		window.open('http://service.t.sina.com.cn/share/share.php?'+temp.join("&"),'_blank');
	}
	this.kaixin = function( o ){
		window.open('http://www.kaixin001.com/repaste/share.php?rtitle=' + encodeURIComponent(o.title) +'&rurl=' + o.url + '&rcontent=' + encodeURIComponent(o.cont));
	}
	this.renren = function( o ){
		window.open('http://share.renren.com/share/buttonshare.do?link=' + o.url+'&title=' + encodeURIComponent(o.cont),'_blank');
	}
	this.douban = function( o ) {
		window.open('http://www.douban.com/recommend/?url=' + o.url + '&title=' + encodeURIComponent(o.cont) + "&cont=cont&image=" + o.pic);
	}

}