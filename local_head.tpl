<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="{$ROOT_URL}themes/default/fix-ie5-ie6.css">
<![endif]-->
{if isset($display_hr_os_banner) and (!$display_hr_os_banner)}
<style type="text/css">
#{$BODY_ID}{literal} #theHeader { {/literal}
	  background: url("{$ROOT_URL}themes/hr_os/img/header.jpg") no-repeat scroll center top transparent;{literal}
    height: 20px;
    margin: 0 auto;
}{/literal}
#{$BODY_ID}{literal} #theHeader * {
	display:none;
}{/literal}
</style>
{/if}
