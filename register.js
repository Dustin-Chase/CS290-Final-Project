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

/*Function to process the user registration request. Sends
* username and password to PHP registration page for 
* processing. 
*/
function register() { 
	//clear any existing error messages
	httpRequest = createHttpRequestObject(); 
	var userName = document.getElementById("username").value;  
	var password1 = document.getElementById("password1").value;
	var password2 = document.getElementById("password2").value;	
	if (userName == "" || password1 == "" || password2 == "") {
		document.getElementById("regError").innerHTML = "ERROR: Please enter both a user name and password.";
	}
	else {
		var data = "submit=true" + "&username=" + userName + "&password1=" + password1 + "&password2=" + password2;  
		httpRequest.open("POST", "register.php", true);
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		httpRequest.send(data);
		
		httpRequest.onreadystatechange = registerStatus; 
	} 
}

function registerStatus()  { 
	if(httpRequest.readyState === 4) {
		if (httpRequest.status === 200) {
			document.getElementById("regError").innerHTML = httpRequest.responseText; 
		} else {
			document.getElementById("regError").innerHTML = "There was a problem with the registration request."; 
		}
	}
		  
}  