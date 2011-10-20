<?php 
/**
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * This is a stub class for service calls made under the Content service.
 * 
 * @author johns
 *
 */
class Content extends Service {
	
	public function getFilteredContent($args) {
		$body = '<ns1:courseId>' . $args['courseId'] . '</ns1:courseId>';
		$body .= '<ns1:filter xmlns:ns2="http://content.ws.blackboard/xsd">';
		
		foreach ($args['filter'] as $key => $arg) {
			$body .= '<ns2:' . $key . '>' . $arg . '</ns2:' . $key . '>';
		}

		$body .= '</ns1:filter>';		
		
		return parent::buildBody("getFilteredContent", "Content", $body);
	}	
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Content', $args[0]);
	}
}

?>