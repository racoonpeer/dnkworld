<{* REQUIRE VARS: dependID=int $arrChildrens=array() *}>
        <optgroup label="">
<{section name=i loop=$arrChildrens}>
            <option value="<{$arrChildrens[i].id}>"<{if $dependID==$arrChildrens[i].id OR (empty($dependID) && $arrPageData.cid==$arrChildrens[i].id)}>  selected<{/if}>><{$arrChildrens[i].margin}><{$arrChildrens[i].title}> &nbsp; [items: <{if isset($arCidCntItems[$arrChildrens[i].id])}><{$arCidCntItems[$arrChildrens[i].id]}><{else}>0<{/if}>] &nbsp; <{if $arrChildrens[i].active==0}>( неактивен ) &nbsp; <{/if}></option>
<{if !empty($arrChildrens[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/tree_childrens.tpl' dependID=$dependID arrChildrens=$arrChildrens[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
        </optgroup>

