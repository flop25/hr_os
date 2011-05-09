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
VALUES ("hr_os" , "'.addslashes(serialize($config)).'" , "hr_os parameters");';

    pwg_query($query);
  }
}

function theme_deactivate()
{
  global $prefixeTable;

  $query = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE param="hr_os" LIMIT 1;';
  pwg_query($query);
}

?>