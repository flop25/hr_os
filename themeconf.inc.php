<?php
/*
Theme Name: hr_os
Version: auto
Description: A theme with an horizontal menu everywhere and a simple modern design
Theme URI: http://piwigo.org/ext/extension_view.php?eid=503
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
  'colorscheme' => 'clear',
);
//// [update check]
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
if (isset($conf['derivatives']))  {    
  $new = @unserialize($conf['derivatives']);
  if(!isset($new['d']['Optimal']))
  {
    $new['d']['Optimal']=ImageStdParams::get_custom(730,9999); 
    $query = '
        UPDATE '.CONFIG_TABLE.'
        SET value="'.addslashes(serialize($new)).'"
        WHERE param = "derivatives"
        LIMIT 1';
    pwg_query($query);
    load_conf_from_db();
  }
}
//// [/update check]


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
// function load_pattern 3.0
// include the right ***.pattern.php
// not compatible Piwigo < 11.0

function load_pattern()
{
  global $pattern;
  $pwgversion=str_replace('.','_',PHPWG_VERSION);
  $pwgversion_array=explode('.', PHPWG_VERSION);
  if (file_exists($pwgversion.'pattern.php'))
  {
    include($pwgversion.'.pattern.php');
    return true;
  }
  elseif (file_exists(PHPWG_ROOT_PATH.'themes/Pure_default/'.$pwgversion_array[0].'.pattern.php'))
  {
    include(PHPWG_ROOT_PATH.'themes/Pure_default/'.$pwgversion_array[0].'.pattern.php');
    return true;
  }
  else
  {
    $list_pattern_path=array();
    $dir=PHPWG_ROOT_PATH.'themes/Pure_default';
    $dh = opendir($dir);
    while (($file = readdir ($dh)) !== false ) {
      if ($file !== '.' && $file !== '..') {
        $path =$dir.'/'.$file;
        if (!is_dir ($path)) { 
          if(strpos($file,'pattern.php')!==false) { //On ne prend que les .pattern.php
            $list_pattern_path[]=$file;
          }
        }
      }
    }
    closedir($dh);
    natsort($list_pattern_path);
    $list_pattern_path=array_reverse($list_pattern_path);
    echo($list_pattern_path[0]);
    include($list_pattern_path[0]);
    return $pattern['return'];
 }
}
if(!load_pattern())
{
  global $page;
  $page['errors'][]='Theme not compatible';
}

/************************************ picture.tpl ************************************/
//add_event_handler('render_element_content', 'hr_os_picture',  EVENT_HANDLER_PRIORITY_NEUTRAL, 20 );
function hr_os_picture($content, $element_info)
{
  global $template;
  $template->set_prefilter('default_content', 'hr_os_prefilter_picture');
  return $content;
}
function hr_os_prefilter_picture($content)
{
  global $pattern;
  $r=$pattern['hr_os_prefilter_picture']['R'];
  $ps=$pattern['hr_os_prefilter_picture']['S'];
  foreach($r as $i => $pr)
  {
    $content = str_replace($ps[$i], $pr, $content);
  }
  
  $content ='{define_derivative name=\'der_hr_os\' width=730 height=9999 crop=false}
{assign var=der value=$pwg->derivative($der_hr_os, $current.src_image)}
'.$content;
  return $content;
}


?>
