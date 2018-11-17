<?php


function getAction() {
	$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
	return $action;
}
function getMessageID() {
	$mid = isset($_GET["mid"]) ? $_GET["mid"] : (isset($_POST["mid"]) ? $_POST["mid"] : 0);

	return $mid;
}
function getMessageParentID() {
	$mid = isset($_GET["forum_parent"]) ? $_GET["forum_parent"] : (isset($_POST["forum_parent"]) ? $_POST["forum_parent"] : 0);

	return $mid;
}

function getMessageGroup() {
	$groups = isset($_GET["groups"]) ? $_GET["groups"] : (isset($_POST["groups"]) ? $_POST["groups"] : 0);

	return $groups;
}
function getCurrentMessage($mess_id, $mess) {
	$ret = '';
	if ($mess->getID() == $mess_id) {
		$ret = $mess;
	}
	else {
		$children = $mess->getChildren();
		if ($children) {
			for ($i = 0; $i < count($children); $i++) {
				if ($children[$i]->getID() == $mess_id) {
					$ret = $children[$i];
					break;
				}
				else if ($children[$i]->getChildren()) {
					$mm = getCurrentMessage($mess_id, $children[$i]);
					if ($mm) {
						$ret = $mm;
						break;
					}
				}
			}
		}
	}
	return $ret;
}
function getCurrentPage() {
	$curr_page = isset($_POST["pages"]) ? $_POST["pages"] : (isset($_GET["pages"]) ? $_GET["pages"] : "1");

	return $curr_page;
}

?>