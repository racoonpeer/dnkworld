<?php /* Smarty version Smarty-3.1.12, created on 2013-09-12 20:24:09
         compiled from "tpl/frontend/smart/core/homeslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104904529517baf490de6b7-02630462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fb35110e0ed9779ec5126e78c815c40497428bb' => 
    array (
      0 => 'tpl/frontend/smart/core/homeslider.tpl',
      1 => 1377326305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104904529517baf490de6b7-02630462',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517baf49475829_46164002',
  'variables' => 
  array (
    'HTMLHelper' => 0,
    'arItems' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517baf49475829_46164002')) {function content_517baf49475829_46164002($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['arItems'] = new Smarty_variable($_smarty_tpl->tpl_vars['HTMLHelper']->value->getSliderItems(), null, 0);?>
<?php if (!empty($_smarty_tpl->tpl_vars['arItems']->value)){?>
<div class="slider" id="header-slider">
    <div class="slides_container">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arItems']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
	<a href="<?php if (!empty($_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['url'])){?><?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['url'];?>
<?php }else{ ?>javascript:void(0);<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
">
	    <img src="<?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['path'];?>
<?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
" align="top" />
<?php if (!empty($_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['descr'])){?>
            <div class="caption"><?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
</div>
<?php }?>
	</a>
<?php endfor; endif; ?>
    </div>
<?php if (count($_smarty_tpl->tpl_vars['arItems']->value)>1){?>
    <a href="javascript:void(0);" class="prev">
	<img src="/images/site/smart/slides/arrow-prev.png" width="18" height="100" alt="">
    </a>
    <a href="javascript:void(0);" class="next">
	<img src="/images/site/smart/slides/arrow-next.png" width="18" height="100" alt="">
    </a>
<?php }?>
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
<?php }?><?php }} ?>