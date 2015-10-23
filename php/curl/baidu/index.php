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
				var data_array = data.split('\n');
				for (var i = 0 ; i < data_array.length - 1 ; i++) {
					rs = "<a target = '_blank' href ='" + data_array[i] + "'>" + data_array[i] + "</a><br />";
					$("#url").append(rs);
				}
			} else {
				$("#url").append('.');
			}
			ajax();
		}
	});
}
</script>
