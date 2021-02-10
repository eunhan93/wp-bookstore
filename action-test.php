<?php
$action_list = [];

function add_action($tag, $function) {
  global $action_list;
  $action_list[$tag][] = $function;
}

function do_action($tag){
  global $action_list;

  if (!empty($action_list[$tag])){
    foreach($action_list[$tag] as $function) {
      call_user_func($function);
    }
  }
  
}

add_action('5지점직전', function () {
  echo 4.5 . '<br />';
});

echo 1 . '<br />';
echo 2 . '<br />';
echo 3 . '<br />';
echo 4 . '<br />';
do_action('5지점직전');
echo 5 . '<br />';
do_action('5지점직후');
echo 6 . '<br />';
echo 7 . '<br />';
echo 8 . '<br />';
echo 9 . '<br />';