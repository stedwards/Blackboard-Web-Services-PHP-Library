<?php 
/**
 * This is a stub class for service calls made under the User service.
 * 
 * @author johns
 *
 */
class User extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'User', $args[0]);
	}
}

?>