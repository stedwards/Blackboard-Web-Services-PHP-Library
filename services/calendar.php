<?php 
/**
 * This is a stub class for service calls made under the Calendar service.
 * 
 * @author johns
 *
 */
class Calendar extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Calendar', $args[0]);
	}
}

?>