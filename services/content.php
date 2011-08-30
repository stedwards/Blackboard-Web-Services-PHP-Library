<?php 
/**
 * This is a stub class for service calls made under the Content service.
 * 
 * @author johns
 *
 */
class Content extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Content', $args[0]);
	}
}

?>