<?php 
/**
 * BbPHP: Blackboard Web Services Library for PHP
 * Copyright (C) 2011 by St. Edward's University (www.stedwards.edu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * The base service class upon which all other services are built.
 * Many services may not need more than this, and exist only as a stub class.
 * 
 * @author johns
 *
 */
class Service {
	
	public function buildBody($method = null, $service, $args = null) {
		
		$body = '<SOAP-ENV:Body xmlns:ns1="http://' . strtolower($service) . '.ws.blackboard">';
		$body .= "<ns1:$method>";
		
		if (!is_array($args) && is_string($args) && $args != null) {
			$body .= $args;
		} else {
			if ($args != null) {
				foreach($args as $key => $arg) {
					if (is_array($arg)) {
						foreach($arg as $sub_arg) {
							$body .= "<ns1:$key>$sub_arg</ns1:$key>";
						}
					} else {
						$body .= "<ns1:$key>$arg</ns1:$key>";
					}
				}
			}
		}
		
		$body .= "</ns1:$method>";
		$body .= '</SOAP-ENV:Body>';
		
		return $body;
	}
}
?>