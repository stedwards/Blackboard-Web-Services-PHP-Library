<?php 
/**
 * This is a stub class for service calls made under the Gradebook service.
 * 
 * @author johns
 *
 */
class Gradebook extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Gradebook', $args[0]);
	}
}

?>