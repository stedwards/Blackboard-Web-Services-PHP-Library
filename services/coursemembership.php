<?php 
/**
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * This is a stub class for service calls made under the CourseMembership service.
 * 
 * @author johns
 *
 */
class CourseMembership extends Service {

	public function getCourseMembership($args) {
		$body = '<ns1:courseId>' . $args['courseId'] . '</ns1:courseId>';
		$body .= '<ns1:f xmlns:ns2="http://coursemembership.ws.blackboard/xsd">';
		
		foreach ($args['f'] as $key => $arg) {
			$body .= '<ns2:' . $key . '>' . $arg . '</ns2:' . $key . '>';
		}

		$body .= '</ns1:f>';		
		
		return parent::buildBody("getCourseMembership", "CourseMembership", $body);
	}	
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'CourseMembership', $args[0]);
	}
}

?>