let arrSize = '';
let index = '0';
let charArr = [];
let httpRequest = new XMLHttpRequest();
let httpRequestABC = new XMLHttpRequest();
let dataABC = '0';
let data123 = '0';

function start()
{
    getDBdata();
}

//Navigation functions
function first()
{
    index = 0;
    loadElements();
}

function prev()
{
    if (index > 0)
    {
        --index;
    }
    loadElements();
}

function next()
{
    if (index < arrSize)
    {
        ++index;
    }

    loadElements();
}

function last()
{
    index = arrSize-1;
    loadElements();
}

//Sort functions
function sortABC()
{
    if (dataABC == "0")
    {
        dataABC = "1";
        getDBdataABC();
        index = "0";
        alert("Sorted ABC");
    }
    else if (dataABC == "1")
    {
        dataABC = "2";
        getDBdataABC();
        index = "0";
        alert("Sorted Reverse")
    }
    else if (dataABC == "2")
    {
        dataABC = "0";
        getDBdata();
        index = "0";
        alert("Unsorted");
    }
    loadElements();
}

function sort123()
{
    if (data123 == "0")
    {
        data123 = "1";
        getDBdata123();
        index = "0";
        alert("Sorted 123");
    }
    else if (data123 == "1")
    {
        data123 = "2";
        getDBdata123();
        index = "0";
        alert("Sorted 321")
    }
    else if (data123 == "2")
    {
        data123 = "0";
        getDBdata();
        index = "0";
        alert("Unsorted");
    }
    loadElements();
}

//Edit functions
function edit()
{
    document.getElementById("name").removeAttribute('readonly');
    document.getElementById("gender").removeAttribute('readonly');
    document.getElementById("year").removeAttribute('readonly');
    document.getElementById("charRole").removeAttribute('disabled');
    document.getElementById("charFireType").removeAttribute('disabled');

    document.getElementById("editBtn").style.display = "none";
    document.getElementById("imgUpload").style.display = "block";
    document.getElementById("navBtns").style.display = "none";
    document.getElementById("editBtns").style.display = "block";
    document.getElementById("addNew").style.display = "block";
    document.getElementById("sortBtnABC").style.display = "none";
    document.getElementById("sortBtn123").style.display = "none";
}

function cancel()
{
    document.getElementById("name").setAttribute('readonly', true);
    document.getElementById("gender").setAttribute('readonly', true);
    document.getElementById("year").setAttribute('readonly', true);
    document.getElementById("charRole").setAttribute('disabled', true);
    document.getElementById("charFireType").setAttribute('disabled', true);

    document.getElementById("editBtn").style.display = "block";
    document.getElementById("imgUpload").style.display = "none";
    document.getElementById("navBtns").style.display = "block";
    document.getElementById("editBtns").style.display = "none";
    document.getElementById("addNew").style.display = "none";
    document.getElementById("sortBtnABC").style.display = "block";
    document.getElementById("sortBtn123").style.display = "block";
}

function addChar()
{
    document.getElementById("pkey").value = "";
    document.getElementById("name").value = "";
    document.getElementById("gender").value = "";
    document.getElementById("year").value = "";
    document.getElementById("tank").checked= false;
    document.getElementById("damage").checked= false;
    document.getElementById("support").checked= false;
    document.getElementById("fireType").checked= false;
    document.getElementById("characterImage").src= "";

    document.getElementById("editBtns").style.display = "none";
    document.getElementById("saveBtns").style.display = "block";

}

let character = 
{
    pkey: "",
    name: "",
    gender: "",
    releaseYear: "",
    hitscan: "",
    role: "",
    image: ""
}


function update()
{
    getInputs();
    httpRequest = new XMLHttpRequest();
    let strx = JSON.stringify(character);
    console.log(strx);
    httpRequest.onreadystatechange = responseUpdate;  // we assign a function to the property onreadystatechange (callback function)
    httpRequest.open('POST','updateChar.php');  // ACTION + (string containing address of the file + parameters if needed)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // application/json; charset=utf-8 is a common Content-Type
    // application/x-www-form-urlencoded; charset=UTF-8 is the default Content-Type
    httpRequest.send("charInfo=" +strx);
}


//load into input fields
function loadElements() 
{
    document.getElementById("pkey").value = charArr[index].pkey;
    document.getElementById("name").value = charArr[index].name;
    document.getElementById("gender").value = charArr[index].gender;
    document.getElementById("year").value = charArr[index].releaseYear;
    
    if (charArr[index].hitscan == 1)
    {
        document.getElementById("fireType").checked = true;
    }
    else
    {
        document.getElementById("fireType").checked = false;
    }

    if(charArr[index].role == "Tank" )
    {
        document.getElementById("tank").checked = true;
    }

    if(charArr[index].role == "Damage" )
    {
        document.getElementById("damage").checked = true;
    }

    if(charArr[index].role == "Support" )
    {
        document.getElementById("support").checked = true;
    }

    document.getElementById("currIndex").innerText = index + 1;
    document.getElementById("indexOf").innerText = arrSize;

    document.getElementById("characterImage").src = charArr[index].image;
}


//Functions for http requests
function getDBdata()
{
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = getDBResults;  // we assign a function to the property onreadystatechange (callback function)
    httpRequest.open('Get','getData.php');  // ACTION + (string containing address of the file + parameters if needed)
    // httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // application/json; charset=utf-8 is a common Content-Type
    // application/x-www-form-urlencoded; charset=UTF-8 is the default Content-Type
    httpRequest.send();
}

function getDBdataABC()
{
    console.log("abc")
    httpRequest = new XMLHttpRequest();
    let strx = JSON.stringify(dataABC);
    httpRequest.onreadystatechange = getDBResults;  // we assign a function to the property onreadystatechange (callback function)
    httpRequest.open('POST','getABC.php');  // ACTION + (string containing address of the file + parameters if needed)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // application/json; charset=utf-8 is a common Content-Type
    // application/x-www-form-urlencoded; charset=UTF-8 is the default Content-Type
    httpRequest.send("sortType=" +strx);
}

function getDBdata123()
{
    console.log("123")
    httpRequest = new XMLHttpRequest();
    let strx = JSON.stringify(data123);
    httpRequest.onreadystatechange = getDBResults;  // we assign a function to the property onreadystatechange (callback function)
    httpRequest.open('POST','get123.php');  // ACTION + (string containing address of the file + parameters if needed)
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // application/json; charset=utf-8 is a common Content-Type
    // application/x-www-form-urlencoded; charset=UTF-8 is the default Content-Type
    httpRequest.send("sortType=" +strx);
}


//call back function
function getDBResults() 
{
    if (httpRequest.readyState === XMLHttpRequest.DONE) 
        {
        if (httpRequest.status === 200) 
        {      
                // We retrieve a piece of text corresponding to some JSON
                // now you have a nice object in the response, you can access its properties and values to populate the different fields of your form
                // the next stages will be about the creation of this JSON from the PHP side, in relation to some data that we extracted from a database
                //alert(httpRequest.responseText); // If you have a bug, use an alert of what is given back from the server (for textual content)
                // if you return something that cannot be converted to an object, then debug the PHP side !
                dbResults = JSON.parse(httpRequest.responseText);
                processDbResults(dbResults);
        } 
        else 
        {
            alert('There was a problem with the request.');
        }
    }
}


function responseUpdate() 
{
    if (httpRequest.readyState === XMLHttpRequest.DONE) 
        {
        if (httpRequest.status === 200) 
        {      
                // We retrieve a piece of text corresponding to some JSON
                // now you have a nice object in the response, you can access its properties and values to populate the different fields of your form
                // the next stages will be about the creation of this JSON from the PHP side, in relation to some data that we extracted from a database
                alert(httpRequest.responseText); // If you have a bug, use an alert of what is given back from the server (for textual content)
                // if you return something that cannot be converted to an object, then debug the PHP side !
        } 
        else 
        {
            alert('There was a problem with the request.');
        }
    }
}

function processDbResults(results)
{
    charArr = new Array();
    arrSize = results.length;
    for(let i=0; i<arrSize; i++)
    {
        charArr[i] = results[i];
    }
    loadElements();
}




