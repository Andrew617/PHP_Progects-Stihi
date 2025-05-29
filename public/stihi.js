async function sendFile()
{
let url = new URL('http://stihi/fromAjax.php');
let xnl = new XMLHttpRequest();
xnl.open("POST", url)
xnl.send();
}

async function sendRequestWithParam()// use fetch
{
let url = new URL('http://stihi/fromAjax.php');
url.searchParams.set([param1], [param2]);
let response = await fetch(url);
if (response.ok){
  let commits = await response.text();
  let paragraphElement = document.createElement("pre", "h5");
  let message = document.createTextNode(commits);
  paragraphElement.appendChild(message);
  document.body.append(paragraphElement);
}
else {
  alert (response.status);
}
} 
async function sendPOSTrequest(post)
{
  let response = await fetch('http://stihi/fromAjax.php',{
  method:'POST',
  headers:{
    'Content-Type':'application/json;charset=utf-8'
  },
  body: JSON.stringify(post)
});
const answer = await response.json()
alert (answer);}


function createObject(text){
  const textObject = {};
  text.forEach((value, key) => {textObject[key]=value; 
  });
return textObject;
}

