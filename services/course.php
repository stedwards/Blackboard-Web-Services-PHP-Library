<?php
/**
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * This is a stub class for service calls made under the Course service.
 * 
 * @author johns
 *
 */
class Course extends Service {
	
	public function getCourse($args) {
		$body = '<ns1:filter xmlns:ns2="http://course.ws.blackboard/xsd">';
		
		foreach ($args as $key => $arg) {
			$body .= '<ns2:' . $key . '>' . $arg . '</ns2:' . $key . '>';
		}

		$body .= '</ns1:filter>';		
		
		return parent::buildBody("getCourse", "Course", $body);
	}

	public function __call($method, $args = null) {
		return parent::buildBody($method, "Course", $args[0]);
	}
}
?>