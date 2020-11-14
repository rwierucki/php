<?php
session_start();
echo '<pre>';
var_dump(session_id());

$_SESSION['session_example'] = 'Short message';


