Welcome to the API. 
How to use: There is a file named api.sql. This is the database file. You need to create a database named api and then import this api.sql file into that. There is only one table named players in the database.

playername, userid, Vault, Inventory - these are the four fields stored in the player table.

Here you can
	create, read, update and delete data

Create Operation: Here you can add any player.
				  Link: http://hostname/api/api/player/createdata.php
				  Method: POST
				  JSON: 
				  		{
						    "playername" : "nakamura2012",
						    "userid" : "112",
						    "Vault" : "The best hereh for amazing programmers.",
						    "Inventory" : "AK49"
						}

Read Operation: Here you can read the player data by userid.
				  Link: http://hostname/api/api/player/getdata.php?id=123
				  Method: GET
				  JSON: Not required

Read All Operation: Here you can read all players data.
				  Link: http://hostname/api/api/player/getalldata.php
				  Method: GET
				  JSON: Not required

Update Operation: Here you can update any player. The userid field in JSON is a must. If you do not 				  add the other fields in the JSON this would not be updated and remain same as the 				  previous one. So, you can only update your required fields.  
				  Link: http://hostname/api/api/player/setdata.php
				  Method: POST
				  JSON: 
				  		{
						    "playername" : "nakamura2012",
						    "Vault" : "The best hereh for amazing programmers.",
						    "Inventory" : "AK49",
						    "userid" : "112"
						}

						Suppose you need to change only username then the JSON would be- 
						{
						    "playername" : "nakamura2012changed",
						    "userid" : "112"
						}
						this would change only the playername. The Vault and Inventory would remain the same.

DELETE Operation: Here you can delete any player.
				  Link: http://hostname/api/api/player/deletedata.php
				  Method: POST
				  JSON: 
				  		{
						    "userid" : "112"
						} 

That is it. Thank you!!!!