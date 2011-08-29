<?php
class Announcement {
	public function getCourseAnnouncements($args) {
		$body = '<ns1:filter xmlns:ns2="http://annountcement.ws.blackboard/xsd">';
		
		foreach ($args as $key => $arg) {
			$body .= '<ns2:' . $key . '>' . $arg . '</ns2:' . $key . '>';
		}

		$body .= '</ns1:filter>';		
		
		return $body;
	}
}
?>