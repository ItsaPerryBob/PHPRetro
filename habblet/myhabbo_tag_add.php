<?php
/*================================================================+\
|| # PHPRetro - An extendable virtual hotel site and management
|+==================================================================
|| # Copyright (C) 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Parts Copyright (C) 2009 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|| # All images, scripts, and layouts
|| # Copyright (C) 2009 Sulake Ltd. All rights reserved.
|+==================================================================
|| # PHPRetro is provided "as is" and comes without
|| # warrenty of any kind. PHPRetro is free software!
|| # License: GNU Public License 3.0
|| # http://opensource.org/licenses/gpl-license.php
\+================================================================*/

$page['dir'] = '\habblet';
$page['allow_guests'] = true;
require_once('../includes/core.php');
require_once('./includes/session.php');

$id = $input->FilterText($_POST['accountId']);
$tag = $input->FilterText($_POST['tagName']);
$tag_correct = $input->stringToURL($input->HoloText($tag));

if(strlen($tag) > 20 || strlen($tag) < 1){ $return = "invalidtag";
}elseif(strnatcasecmp($tag,$tag_correct) != false){ $return = "invalidtag";
}elseif($id != $user->id){ $return = "invalidtag";
}elseif($db->result($db->query("SELECT COUNT(*) FROM ".PREFIX."tags WHERE ownerid = '".$id."' AND tag = '".$tag."' AND type = 'user'")) > 0){ $return = "invalidtag";
}elseif($db->result($db->query("SELECT COUNT(*) FROM ".PREFIX."tags WHERE ownerid = '".$id."' AND type = 'user'")) > 19){ $return = "invalidtag";
}else{
$db->query("INSERT INTO ".PREFIX."tags (ownerid,tag,type) VALUES ('".$id."','".strtolower($tag)."','user')");
$return = "valid";
}
echo $return;
?>