<?php
session_start();
//
$var1 = 'openChatBoxes';
$var2 = 'chatHistory';
$var3 = 'tsChatBoxes';
unset($var1, $var2, $var3);
session_destroy();
//
header('Location: ../');