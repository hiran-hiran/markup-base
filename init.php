<?php

function view($view, $vars=array()){
  extract($vars);
  include dirname(__FILE__) . "/parts/{$view}.php";
}
