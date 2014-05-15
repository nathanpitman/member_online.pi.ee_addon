member_online.pi.ee_addon
=========================

Return the online status of any member based on username. Useful if you want to display a members online status on a profile page of some sort much like Facebook does.

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
