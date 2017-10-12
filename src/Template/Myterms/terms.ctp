<?php
use Cake\Core\App;
if($_SESSION['LocaleCodeb'] == "es_CR"){
  require current(App::path("Template")).'/Myterms'.DS.'es.ctp';
}else{
  require current(App::path("Template")).'/Myterms'.DS.'en.ctp';
}
