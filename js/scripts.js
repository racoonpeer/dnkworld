
MAINFRAME = {
    init: function() {
	var _self = this;
	
	_self.adjust();
	$(window).bind('resize', function(){
	    _self.adjust();
	});
    },
    adjust: function() {
	var winHeight = document.documentElement.clientHeight;
	var outHeight = $('div.headerbar').height() + $('div.footerbar').height() + 120;
	$('div.container').css({
	    'min-height' : Math.floor(winHeight - outHeight) + 'px'
	});
    }
}

IGallery = {
    itemW : 130,
    marginLeft: 10,        
    container : '.iGallery',
    caption : '.iGallery > .screen .caption',
    screen : '.iGallery > .screen',
    pager : '.iGallery > .filmstrip ul',
    controls: {
        next: '.iGallery > .control.next',
        prev: '.iGallery > .control.prev'
    },
    init: function() {
        var _self = this;
        
        var index = 0;
        var start = 0;
        
        var pages = $(_self.pager).children('li').children('a');
        var count = $(pages).size();
        var range = count - 1;
        
        _self.setUp(index);
        
        $(_self.controls.next).bind('click', function() {
            if (index < range) {
                index = (index + 1);
            } else {
                index = 0;
            }
            _self.play(index, count);
        });
        $(_self.controls.prev).bind('click', function() {
            if (index > start) {
                index = (index - 1);
            } else {
                index = range;
            }
            _self.play(index, count);
        });
        
        $(_self.screen).children('img').bind('click', function(){
            _self.expand(index);
        });
        
        $(_self.pager).children('li').children('a').bind('click', function(e) {
            index = $(this).data('index');
            _self.play(index, count);
        });
    },
    setUp: function(index) {
        var _self = this;
        var pages = $(_self.pager).children('li').children('a');
        var src = $(pages).eq(index).data('src');
        $(_self.screen).children('img').attr('src', src);
        $(pages).each(function(i, el){
            var img = $(el).children('img');
            var imgW = img[0].clientWidth;
        });
    },
    play: function(index, count) {
        var _self = this;
        var pages = $(_self.pager).children('li').children('a');
        var src = $(pages).eq(index).data('src');
        var caption = $(pages).eq(index).data('caption');
        $(_self.screen).children('img').attr('src', src);
        $(_self.caption).html(caption);
        $(_self.pager).children('li').each(function(i, el) {
            $(el).children('a').removeClass('active');
        });
        $(_self.pager).children('li').eq(index).children('a').addClass('active');
        
        if (index > 3 && index < (count-2)) {
            $(_self.pager).stop().animate({
                marginLeft: -((index-3) * (_self.itemW + _self.marginLeft))
            } , 200);
            console.log({'var' : 1});
        }
        
        if (index >= 0 && index < 3 && count > 5) {
            $(_self.pager).stop().animate({
                marginLeft: 0
            } , 200);
            console.log({'var' : 2});
        } else if (index <= count-1 && index > (count - 3) && count > 5) {
            $(_self.pager).stop().animate({
                marginLeft: -((count-5) * (_self.itemW + _self.marginLeft))
            }, 200);
            console.log({'var' : 3});
        } else if (count > 5) {
            $(_self.pager).stop().animate({
                marginLeft: -((index-2) * (_self.itemW + _self.marginLeft))
            }, 200);
            console.log({'var' : 4});
        }
    },
    expand: function(index) {
	var _self = this;
	var seq = (index > 0)? index: 0;
	var srcs = {};
	var total = 0;
	for (var i = 0; i < $(_self.pager).children('li').size(); i++) {
	    srcs[i] = $(_self.pager).children('li').eq(i).children('a').data('src');
	    total++;
	}

	$('body').prepend('<div class="modal-container"><a class="close"><img src="/images/site/smart/gallery/close.png" alt="Close" align="top" /></a><div><div class="screen"><img src="' + srcs[seq] + '" alt="" align="top" /></div><a class="next"></a><a class="prev"></a></div></div>');
	var screen = $('div.modal-container div.screen').find('img');
	// next
	$('div.modal-container').find('a.next').click(function(){
	    if(seq < total) {
		seq++;
	    } else {
		seq = total-1;
	    }
	    $(screen).attr('src', srcs[seq]);
	    console.log({'clicked': srcs[seq]});
	});
	// next
	$('div.modal-container').find('a.prev').click(function(){
	    if(seq >= 0) {
		seq--;
	    } else {
		seq = 0;
	    }
	    $(screen).attr('src', srcs[seq]);
	    console.log({'clicked': srcs[seq]});
	});
	// close
	$('div.modal-container').find('a.close').click(function(){
	    $(this).parent().remove();
	});
    }
}