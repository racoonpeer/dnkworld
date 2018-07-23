<{if !empty($item)}>
    <img src="<{$item.src}>" title="<{$item.title}>" alt="<{$item.title}>" />
<{else}>
    <{$smarty.const.FILE_NOT_FOUND}>
<{/if}>