<?php
/*
Theme Name: hr_os
Version: auto
Description: A theme with an horizontal menu everywhere and a simple modern design
Theme URI: http://fr.piwigo.org/ext/extension_view.php?eid=503
Author: flop25
Author URI: http://www.planete-flop.fr
*/
$themeconf = array(
  'name'          => 'hr_os',
  'parent'        => 'default',
  'icon_dir'      => 'themes/hr_os/icon',
  'mime_icon_dir' => 'themes/hr_os/icon/mimetypes/',
  'local_head'    => 'local_head.tpl',
  'activable'     => true,
);
// Need upgrade?
  if (!isset($conf['hr_os']))
  {
    $config = array(
      'home'       => true,
      'categories' => true,
      'picture'    => false,
      'other'      => true,
      );
      
    $query = '
INSERT INTO ' . CONFIG_TABLE . ' (param,value,comment)
VALUES ("hr_os" , "'.pwg_db_real_escape_string(serialize($config)).'" , "hr_os parameters");';

    pwg_query($query);
    load_conf_from_db();
  }
// thx to P@t
add_event_handler('loc_begin_page_header', 'set_hr_os_header');

function set_hr_os_header()
{
  global $page, $conf, $template;

  $config = unserialize($conf['hr_os']);

  if (isset($page['body_id']) and $page['body_id'] == 'theCategoryPage')
  {
    $header = isset($page['category']) ? $config['categories'] : $config['home'];
  }
  elseif (isset($page['body_id']) and $page['body_id'] == 'thePicturePage')
  {
    $header = $config['picture'];
  }
  else
  {
    $header = $config['other'];
  }

  $template->assign('display_hr_os_banner', $header);
}

?>
