/*
Function call when window loads or is refreshed. 
This function checks local storage for any favorites 
and displays them.
*/
window.onload = function () {
	//load the user's comics from the database
	var userName = document.getElementById("user").textContent;
	//strip out extra text around the username
	userName = userName.substring(9, userName.indexOf("!")); 
	loadContents(userName); 
}
//create the http request 
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

function loadContents(username) {
	//clear any existing headings
	httpRequest = createHttpRequestObject(); 
	var data = "submit=true" + "&username=" + username;  
	httpRequest.open("POST", "bookdata.php", true);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.send(data);
		
	httpRequest.onreadystatechange = outputContents; 
	
}
function outputContents()  { 
	if(httpRequest.readyState === 4) {
		if (httpRequest.status === 200) {
			//get and format data returned
			var comicArray = JSON.parse(httpRequest.responseText);
			var mybooksdiv = document.getElementById("mybooks"); 
			//create table and headers
			var table = document.createElement('table');
			table.setAttribute('border', '1');
			var tbody = document.createElement('tbody'); 
			for (var index = 0; index < comicArray.length; index++) {
				var next = comicArray[index];
				var tr = table.insertRow(); 
				for (var i = 2; i <= 8; i++) {
					var td = tr.insertCell();
					td.appendChild(document.createTextNode(next[i]));
					td.style.border = "1px solid black";	
				}
			}
			mybooksdiv.appendChild(table); 
		} else {
			document.getElementById("mybooks").innerHTML = "There was a problem getting your book data."; 
		}
	}
		  
}  

