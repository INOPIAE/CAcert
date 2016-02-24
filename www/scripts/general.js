
function explode(e) {
    if (document.getElementById(e).style.display == 'none') {
        document.getElementById(e).style.display = 'block';
    } else {
        document.getElementById(e).style.display = 'none';
    }
}

function hideall() {
        var Nodes = document.getElementsByTagName('ul')
        var max = Nodes.length
        for(var i = 0;i < max;i++) {
            var nodeObj = Nodes.item(i)
            if (nodeObj.className == "menu") {
                nodeObj.style.display = 'none';
            }
        }
}

function showExpertMulti(a)
{
  b=document.getElementsByName("expert");
  if (b) for(i=0;b.length>i;i++)
  {
    if(!a) {b[i].setAttribute("style","display:none"); }
    else {b[i].removeAttribute("style");}
  }
  b=document.getElementsByName("expertoff");
  if (b) for(i=0;b.length>i;i++)
  {
    b[i].removeAttribute("style");
  }

}
showExpertMulti(false);


function showExpertSingle(a)
{
	var options=document.getElementById("advanced_options");
	options.style.display = (a) ? "" : "none";

	var checkbox=document.getElementById("expertbox");
	checkbox.style.display = "";
}
showExpertSingle(false);

