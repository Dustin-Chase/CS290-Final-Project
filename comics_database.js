
/*Function to create http request object.
*/
function createHttpRequestObject() {
	var xmlHttp;

	/*Code Source: Mozilla.org - Getting Started with Ajax*/	
	if(window.ActiveXObject) {
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e) {
			xmlHttp = false;
		}			
	} 
	else {
		try {
			xmlHttp = new XMLHttpRequest(); 
		} catch(e) {
			xmlHttp = false; 
		}
	}
	
	if(!xmlHttp)
		alert("Could not create XML Request");
	else {
		return xmlHttp; 
	}
}
var httpRequest; 

/*Function to process the user login request. Sends
* username and password to PHP login page for 
* processing. 
*/
function logIn() { 
	//clear any existing error messages
	document.getElementById("loginError").innerHTML = "";
	httpRequest = createHttpRequestObject(); 
	var userName = document.getElementById("username").value;  
	var password = document.getElementById("password").value; 
	if (userName == "" || password == "") {
		document.getElementById("loginError").innerHTML = "ERROR: Please enter both a user name and password.";
	}
	else {
		var data = "username=" + userName + "&" + "password=" + password;  
		httpRequest.open("POST", "login.php", true);
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		httpRequest.send(data);
		
		httpRequest.onreadystatechange = logInStatus; 
	} 
}

function logInStatus()  { 
	if(httpRequest.readyState === 4) {
		if (httpRequest.status === 200) {
			document.getElementById("loginError").innerHTML = httpRequest.responseText; 
		} else {
			document.getElementById("loginError").innerHTML = "There was a problem with the login request."; 
		}
	}
		  
}  


