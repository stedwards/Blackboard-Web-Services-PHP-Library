<?php 
/**
 * This is a stub class for service calls made under the Util service.
 * 
 * @author johns
 *
 */
class Util extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Util', $args[0]);
	}
}

?>