<?php
require ('../include/init.inc.php');

Template::assign("_POST" ,$_POST);
Template::display('forget_password.tpl');
