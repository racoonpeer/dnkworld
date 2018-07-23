<{assign var=arItems value=$HTMLHelper->getSliderItems()}>
<{if !empty($arItems)}>
<div class="slider" id="header-slider">
    <div class="slides_container">
<{section name=i loop=$arItems}>
	<a href="<{if !empty($arItems[i].url)}><{$arItems[i].url}><{else}>javascript:void(0);<{/if}>" title="<{$arItems[i].title}>">
	    <img src="<{$arItems[i].path}><{$arItems[i].image}>" alt="<{$arItems[i].title}>" align="top" />
<{if !empty($arItems[i].descr)}>
            <div class="caption"><{$arItems[i].descr}></div>
<{/if}>
	</a>
<{/section}>
    </div>
<{if count($arItems) > 1}>
    <a href="javascript:void(0);" class="prev">
	<img src="/images/site/smart/slides/arrow-prev.png" width="18" height="100" alt="">
    </a>
    <a href="javascript:void(0);" class="next">
	<img src="/images/site/smart/slides/arrow-next.png" width="18" height="100" alt="">
    </a>
<{/if}>
</div>
<div>
    <img src="/images/site/smart/slides/shadow.png" width="940" align="top" />
</div>
<script type="text/javascript" src="/js/jquery/slidesjs/min/slides.min.jquery.js"></script>
<script type="text/javascript">
    $(function(){
        
        var Slides = $('#header-slider').find('.slides_container').find('a');
        $(Slides).each(function(n, slide){
            var caption = $(slide).children('.caption');
            $(caption).hide();
        });
        setTimeout(function(){
            $(Slides[0]).find('.caption').slideDown();
        }, 400);
        
	$('#header-slider').slides({
	    preload: true,
	    preloadImage: '/images/site/smart/slides/loading.gif',
	    slideSpeed: 450,
	    play: 6000,
	    pause: 3000,
	    hoverPause: true,
	    autoPlay: false,
	    pagination: true,
            currentClass: 'current',
            animationStart: function() {
                $(Slides).each(function(n, slide){
                    var caption = $(slide).children('.caption');
                    $(caption).hide();
                });
            },
            animationComplete: function(i) {
                setTimeout(function(){
                    $(Slides[i-1]).find('.caption').slideDown();
                }, 400);
            }
	});
    });
</script>
<{/if}>