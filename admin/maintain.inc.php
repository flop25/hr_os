<?php

function theme_activate($id, $version, &$errors)
{
  global $prefixeTable, $conf;

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
  }
  if (isset($conf['derivatives']))  {    
    $new = @unserialize($conf['derivatives']);
    $new['d']['Optimal']=ImageStdParams::get_custom(730,9999); 
    $query = '
        UPDATE '.CONFIG_TABLE.'
        SET value="'.pwg_db_real_escape_string(serialize($new)).'"
        WHERE param = "derivatives"
        LIMIT 1';
    pwg_query($query);
    load_conf_from_db();
  }
}

function theme_deactivate()
{
  global $prefixeTable;

  $query = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE param="hr_os" LIMIT 1;';
  pwg_query($query);
  if (isset($conf['derivatives']))  {    
    $new = @unserialize($conf['derivatives']);
    if( isset($new['d']['Optimal']))
    {
      unset($new['d']['Optimal']);
      $conf['derivatives']=serialize($new);
      $query = '
          UPDATE '.CONFIG_TABLE.'
          SET value="'.addslashes(serialize($new)).'"
          WHERE param = "derivatives"
          LIMIT 1';
      pwg_query($query);
    }
  }
}

?>