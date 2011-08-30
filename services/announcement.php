<?php 
/**
 * This is a stub class for service calls made under the Announcement service.
 * 
 * @author johns
 *
 */
class Announcement extends Service {
	
	public function __call($method, $args = null) {
		return parent::buildBody($method, 'Announcement', $args[0]);
	}
}

?>