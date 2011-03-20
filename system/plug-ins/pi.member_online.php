<?php

$plugin_info = array(
	'pi_name'			=> 'Member Online?',
	'pi_version'		=> '1.2',
	'pi_author'			=> 'Nine Four',
	'pi_author_url'		=> 'http://ninefour.co.uk/labs',
	'pi_description'	=> 'Return the online status of any member based on username',
	'pi_usage'			=> member_online::usage()
);

class member_online {

	var $username = "";
	var $return = "";
	
	function member_online()
	{
		global $TMPL, $DB;

		// Get username from template
		$username = $TMPL->fetch_param('username');
		$return = $TMPL->fetch_param('return');
        
		if ($return != "") {
        	$returnParts = split(',',$return);
        	$return_true = $returnParts[0];
        	$return_false = $returnParts[1];
        } else {
        	$return_true = "true";
       		$return_false = "false";
        }
		
		// If username is set
		if ($username != "") {
			$sql = "SELECT exp_members.* FROM exp_online_users, exp_members WHERE (exp_members.username='".$DB->escape_str($username)."' AND exp_online_users.member_id=exp_members.member_id)";
			$DB->fetch_fields = TRUE;
			$query = $DB->query($sql);
			
			// If the username exist in the exp_members table and the corresponding member_id exists in the emp_online_users table
			if ($query->num_rows == 1) {
				$this->return_data = $return_true;
			} else {
				$this->return_data = $return_false;
				return;
			}
		// Username not set, return an error in place of the status
		} else {
			$this->return_data = "Error: The username parameter is required!";
			return;
		}
		
	}
	

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>

BASIC USAGE:

{exp:member_online username='randolfturpin' return="Online,Offline"}

PARAMETERS:

username = 'randolfturpin' (no default - must be specified)
 - The username parameter defines what username you want to return the online status for.
	
return = 'Online,Offline' (default - 'true,false')
 - The return parameter defines what string is returned by the plug-in if the user is online or offline.
	
RELEASE NOTES:

1.2 - Re-branded as a 'Nine Four' plug-in.
1.1 - Revised SQL Query, combining two DB lookups into one - thanks to Drew (McLellan) for the suggestion.
1.0 - Initial Release.

For updates and support check the developers website: http://ninefour.co.uk/labs


<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}


}
?>