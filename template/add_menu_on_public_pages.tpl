<!-- Menu has been provided by the "Spread menus" -->

{html_head}
{if !empty($themeconf.spread_menus)}
<link rel="stylesheet" type="text/css" href="{$ROOT_URL}themes/{$themeconf.id}/css/{$themeconf.spread_menus}.css">
{else}
<link rel="stylesheet" type="text/css" href="{$SPREADM.Path}css/spread_menus_with_{$themeconf.id}.css">
{/if}
{/html_head}

{$MENUBAR}
{assign var='MENUBAR' value=''}