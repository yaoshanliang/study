/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-11-05
 * @File:
 * @Function:
 */
function testAjax (url, method, content) {
    //测试
    var xmlhttprequest = getXmlHttpRequestObject();
    var method = arguments[1] ? arguments[1] : "POST";
    var method = (typeof method !== 'undefined') ? method : "POST";
    var method = method || "POST";
    var content = arguments[2] ? arguments[2] : null;

    xmlhttprequest.onreadystatechange = onReadyStateChange;
    xmlhttprequest.open(method, url, true);
    if (method == "POST") {//POST方法时候需要设置Content-Type
        xmlhttprequest.setRequestHeader("Content-Type", "application/x-www-form-urlencode");
        xmlhttprequest.send(content);
    }
    xmlhttprequest.send(null);

    function getXmlHttpRequestObject() {
        var xmlhttprequest = null;
        try {
            xmlhttprequest = new XMLHttpRequest();//chrome等浏览器
        } catch(e) {
            try {
                xmlhttprequest = new ActiveXObject("Msml2.XMLHTTP");//IE
            } catch (e) {
                try {
                    xmlhttprequest = new ActiveXObject("Microsoft.XMLHTTP")//IE
                } catch (e) {
                    return false;
                }
            }
        }

        return xmlhttprequest;
    }

    //指定状态改变时触发的事件
    function onReadyStateChange() {
        stateChange();
    }

    //
    function stateChange() {
        alert(xmlhttprequest.readyState);//可以发现状态一次为1：正在加载，2：已加载，3：交互中，4：完成
        /*if (xmlhttprequest.readyState == 4) {//已发送请求
            if (xmlhttprequest.status == 200) {
                //请求成功
                //var result = getRespose();
                alert("请求成功！");
            }
            alert("发送失败！")
        } else {
            //请求失败
            alert("请求失败！")
        }*/
    }

    //获取返回结果
    function getResponse(type) {
        var type = arguments[0] ? arguments[0] : "text";//设置默认值text
        return type == "text" ? xmlhttprequest.responseText : xmlhttprequest.responseXML;
    }


}