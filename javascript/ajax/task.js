function IsDigit(cCheck)
{
	return (('0'<=cCheck) && (cCheck<='9'));
}

function IsAlpha(cCheck)
{
	return ((('a'<=cCheck) && (cCheck<='z')) || (('A'<=cCheck) && (cCheck<='Z')))
}

function IsValid(testing)
{
	var struserName = testing;
	for (nIndex=0; nIndex<struserName.length; nIndex++)
	{
		cCheck = struserName.charAt(nIndex);
		if (!(IsDigit(cCheck) || IsAlpha(cCheck)||cCheck=='_'))
			{
				return false;
			}
		}
		return true;
}
function CFirstword()
{
	var struserName = reg.Username.value;
	var first = struserName.charAt(0);
	return(('0'<=first)&&(first<='9'));
}
function Clength()
{
	return(reg.Userpassword.value.length<8);
}
function Cisdigword()
{
	var struserpassword = reg.Userpassword.value;
	var number1=0,number2=0;
	for (nIndex=0; nIndex<struserpassword.length; nIndex++)
	{
		cCheck = struserpassword.charAt(nIndex);
		if (IsDigit(cCheck))
		{
			number1=1;
		}
        if(IsAlpha(cCheck))
		{
		 	number2=1;
		}
	}
	return(number1-number2);
}
function docheck()
{
	if(reg.Username.value=="")
	{
		alert("请输入用户名");
	    return false;
	}
	else if(!IsValid(reg.Username.value))
	{
	 	alert("用户名只能使用字母,数字和下划线");
	 	return false;
	}
	else if(CFirstword())
	{
		alert("用户名不能以数字开头");
	 	return false;
	}
	else if(reg.Userpassword.value=="")
	{
	    alert("请输入密码");
	    return false;
	}
	else if(!IsValid(reg.Userpassword.value))
	{
	 	alert("密码只能使用字母,数字和下划线");
	 	return false;
	}
	else if(Clength())
	{
        alert("密码长度不低于8位");
	 	return false;
	}
	else if(Cisdigword())
	{
		alert("密码必须包含数字和字母");
	 	return false;
	}
	checkname();
	if(id='checkbox')
	{
		alert("111111")
	}
	if(!(id='checkbox'))
	{
		alert("222222")
	}
}
function GetXmlHttpObject(){
	var xmlHttp=null;
	try{
	 	xmlHttp=new XMLHttpRequest();
	 }
	 catch (e){
		 try{
		 	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		 }
		 catch (e){
		 	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		 }
	}
	return xmlHttp;
}

function checkname(){

	//alert("hhhhhhhh");
	var XHR;
	//var username = document.reg.username.value;
	XHR = createXHR();
	var url = "check.php";
	url = url + "?q=" + reg.Username.value;
	url = url + "&sid=" + Math.random
	//alert("hfesef");
	url = url + "?p=" + reg.Userpassword.value
	XHR.onreadystatechange = byhongfei;
	alert("2222222345");
	XHR.open("POST",url,true);
	alert("000000");
	XHR.send(null);
	alert("45765");
	function createXHR(){
	var XHR;

	if(window.ActiveXObject){
		XHR = new ActiveXObject('Microsoft.XMLHTTP');
    }
    else if(window.XMLHttpRequest){
		XHR = new XMLHttpRequest();
		}
	return XHR;
}
	function byhongfei()
	{
		alert("asdf");
		if(XHR.readyState == 4){//关于Ajax引擎对象中的方法和属性，可以参考我的另一篇博文：http://www.cnblogs.com/hongfei/archive/2011/11/29/2265377.html
	    	if(XHR.status == 200){
	    		var textHTML=XHR.responseText;
				// alert(textHTML);
	    		document.getElementById('checkbox').innerHTML=textHTML;
			}
		}

	}
}


