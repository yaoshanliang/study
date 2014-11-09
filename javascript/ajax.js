/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-11-05
 * @File:
 * @Function:
 */
function testAjax (url, method, content) {
    var xmlhttprequest = getXmlHttpRequestObject();//实例XMLHttpRequest对象
/*    var method = arguments[1] ? arguments[1] : "POST";
    var method = (typeof method !== 'undefined') ? method : "POST";
    var method = method || "POST";
    var content = arguments[2] ? arguments[2] : null;*/

    xmlhttprequest.onreadystatechange = onReadyStateChange;//状态改变触发函数
    xmlhttprequest.open(method, url, true);
    //POST方法时候需要设置Content-Type
    if (method == "POST") {
        xmlhttprequest.setRequestHeader("Content-Type", "application/x-www-form-urlencode");
    }
    xmlhttprequest.send(content);

    function getXmlHttpRequestObject() {
        var xmlhttprequest = null;
        //非IE
        if(window.XMLHttpRequest) {
            xmlhttprequest = new XMLHttpRequest();
        } else if(window.ActiveXObject) {
            try {
                xmlhttprequest = new ActiveXObject("Msml2.XMLHTTP.3.0");
            } catch(e) {
                try {
                    xmlhttprequest = new ActiveXObject("Msml2.XMLHTTP.6.0");
                } catch(e) {
                    try {
                        xmlhttprequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch(e) {
                        return;
                    }
                }
            }
        }

        return xmlhttprequest;
    }

    //指定状态改变时触发的事件
    function onReadyStateChange() {
        //请求已发送，并且请求成功
        if (xmlhttprequest.readyState == 4 && xmlhttprequest.status == 200) {
            alert(xmlhttprequest.responseText);
        }
    }


    //获取返回结果
    function getResponse(type) {
        var type = arguments[0] ? arguments[0] : "text";//设置默认值text
        return type == "text" ? xmlhttprequest.responseText : xmlhttprequest.responseXML;
    }


}

function check() {
    //do some check
    return CHECK通过 ? true : false;
}