Blackboard Web Services Library for PHP
=======================================

This is a library for connecting to Blackboard SOAP Web Services from PHP. 
We have tested this against our installation of Blackboard Learn 9.1.60230.0.

Why not use PHP's built in SOAP functionality?
----------------------------------------------

Blackboard's Web Services require the use of the WS-Security stack when 
communicating with other systems. Unfortunately, PHP's built-in SOAP library 
does not support WS-Security. Because of this, a library had to be built to 
create the connection between PHP and Blackboard.

After much time, we determined that even using the built-in SOAP library and 
modifying the SOAP headers was not enough to connect.

So, how did you build this?
---------------------------

We installed a library for Blackboard written in Python and used Wireshark, 
a network analysis tool, to inspect the packets being sent from the Python 
library to Blackboard. We then reconstructed the XML and headers sent from 
that library using cURL in PHP. Using cURL (or built-in PHP streams), we then
successfully connected to Blackboard to perform operations. 