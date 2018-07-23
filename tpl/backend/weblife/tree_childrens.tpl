<{* REQUIRE VARS: itemID=int dependID=int $arrChildrens=array() *}>
                    <optgroup label="">
<{section name=i loop=$arrChildrens}>
                    <option value="<{$arrChildrens[i].id}>"<{if $dependID==$arrChildrens[i].id OR (empty($dependID) && $arrPageData.pid==$arrChildrens[i].id)}>  selected<{/if}><{if $arrChildrens[i].id==$itemID}> disabled<{/if}>><{$arrChildrens[i].margin}><{$arrChildrens[i].title}> &nbsp; ( <{if $arrChildrens[i].active==0}>неактивна, <{/if}><{$arrChildrens[i].menutitle|lower}> ) &nbsp; </option>
<{if !empty($arrChildrens[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='tree_childrens.tpl' itemID=$itemID dependID=$dependID arrChildrens=$arrChildrens[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
                    </optgroup>

