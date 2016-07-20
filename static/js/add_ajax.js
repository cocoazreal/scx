// 显示材料
function showMaterial(){
    var xmlHttp = GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    xmlHttp.onreadystatechange = function(){
        if (xmlHttp.readyState==4 && xmlHttp.status==200)
        {
            document.getElementById("showMaterial").style.display = "block";
            document.getElementById("showMaterial").innerHTML = xmlHttp.responseText;
        }
    }

    var url = '/index.php/Others/recentMaterial'
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}


// 选择材料后触发
function selectMaterial(e){
    document.getElementById("materialNumber").value = e.innerHTML;
    document.getElementById("showMaterial").style.display = "none";
}

// 显示模具
function showMould(){
    var xmlHttp = GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    xmlHttp.onreadystatechange = function(){
        if (xmlHttp.readyState==4 && xmlHttp.status==200)
        {
            document.getElementById("showMould").style.display = "block";
            document.getElementById("showMould").innerHTML = xmlHttp.responseText;
        }
    }

    var url = '/index.php/Others/recentMould'
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

// 选择模具后触发
function selectMould(e){
    document.getElementById("mouldNumber").value = e.innerHTML;
    document.getElementById("showMould").style.display = "none";
}

// 显示厂商
function showCompany(){
    var xmlHttp = GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    xmlHttp.onreadystatechange = function(){
        if (xmlHttp.readyState==4 && xmlHttp.status==200)
        {
            document.getElementById("showCompany").style.display = "block";
            document.getElementById("showCompany").innerHTML = xmlHttp.responseText;
        }
    }

    var url = '/index.php/Others/recentCompany'
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

// 选择厂商后触发
function selectCompany(e){
    document.getElementById("companyNumber").value = e.innerHTML;
    document.getElementById("showCompany").style.display = "none";
}

// 显示工艺
function showProcess(){
    var xmlHttp = GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    xmlHttp.onreadystatechange = function(){
        if (xmlHttp.readyState==4 && xmlHttp.status==200)
        {
            document.getElementById("showProcess").style.display = "block";
            document.getElementById("showProcess").innerHTML = xmlHttp.responseText;
        }
    }

    var url = '/index.php/Production/recentProcess'
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

// 选择工艺后触发
function selectProcess(e){
    document.getElementById("processNumber").value = e.innerHTML;
    document.getElementById("showProcess").style.display = "none";
}

// 失去焦点后自动关闭所有弹出框
function noModal(){
    document.getElementById("showMaterial").style.display = "none";
    document.getElementById("showMould").style.display = "none";
    document.getElementById("showCompany").style.display = "none";
    document.getElementById("showProcess").style.display = "none";
}

// 失去焦点后自动关闭弹出框
function noCompanyModal(){
    document.getElementById("showCompany").style.display = "none";
}

// 失去焦点后自动关闭弹出框
function noMaterialModal(){
    document.getElementById("showMaterial").style.display = "none";
}

// ajax
function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

