
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

function showExpertSingle(a)
{
    var options=document.getElementById("advanced_options");
    options.style.display = (a) ? "" : "none";

    var checkbox=document.getElementById("expertbox");
    checkbox.style.display = "";
}

function Show_Stuff()
{
    if (document.getElementById("display1").style.display == "none")
    {
        document.getElementById("display1").style.display = "";
    } else {
        document.getElementById("display1").style.display = "none";
    }
}

window.onload = function() {
    var d1 = document.getElementById("display1");
    if(d1) {
        d1.style.display = "none";
    }

    showExpertMulti(false);
    showExpertSingle(false);
    var tagShowAdvanced = document.getElementById("showAdvanced");
    if (tagShowAdvanced) {
        if (tagShowAdvanced.dataset.expert == "single") {
            showExpertSingle(false);
        }
    }
    
    var eb = document.getElementById("expertbox");
    if(eb) {
        if(eb.dataset) {
            if(eb.dataset.expert == "single") { 
                eb.onchange=showExpertSingle; 
            } else if (eb.dataset.expert == "multi"){
            	eb.onchange=showExpertMulti;
            }
        }
    }

}
