<div id = 'url'></div>
<script language="javascript" src="jquery-1.11.1.min.js"></script>
<script>
ajax();
function ajax() {
    $.ajax({
		url : "http://iat.baidu.com/baidu.php",
        type : "GET",
        success : function(data) {
			if(data != '.') {
				$("#url").append('<br />');
				data = "<a target = '_blank' href ='" + data + "'>" + data + "</a><br />";
			}
            $("#url").append(data);
			ajax();
		}
	});
}
</script>
