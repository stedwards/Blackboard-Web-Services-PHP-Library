<?php 
/**
 * This is a stub class for service calls made under the Context service.
 * 
 * @author johns
 *
 */
class Context extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Context', $args[0]);
	}
}

?>