//This is where any outside includes might be put, such as system-wide 
  program tasks.  A sample include would be the hello-world include.
include("includes/samples/hello-world.res");

//This is the app initiation stuff...
if($_GET[initapp]) {
	//Interface Sends to App
	//All variables and things that need 
        //to be run will start from here.
	if($_GET[initapp] == "main" || empty($_GET[initapp]) {
		//Standard Start Procedure.  This will run if no init 
                //is specified.
	} elseif($_GET[initapp] == "mini") {
		//App starts in "mini" mode: Slim Apps cut back on 
                //graphics, and sometimes specify less features or 
                //only the basic of tools that are needed.
	} elseif($_GET[initapp] == "info") {
		//This is the run mode for application help.  It will 
                //start up in information mode, giving basic help for
                //the app.
	}
}
