<{* REQUIRE VARS: dependIDS=array() $arrChildrens=array() *}>
        <optgroup label="">
<{section name=i loop=$arrChildrens}>
            <option value="<{$arrChildrens[i].id}>"<{if in_array($arrChildrens[i].id,$dependIDS)}>  selected<{/if}>> &nbsp; <{$arrChildrens[i].title}>  &nbsp; </option>
<{if !empty($arrChildrens[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/multitree_childrens_multiselect.tpl' dependIDS=$dependIDS arrChildrens=$arrChildrens[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
        </optgroup>

