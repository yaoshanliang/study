$provinces_name = array('北京', '天津', '上海', '重庆', '黑龙江', '吉林', '辽宁', '河北', '山东', '山西', '内蒙古', '河南', '陕西',
	 '湖北', '安徽', '江苏', '浙江', '江西', '福建', '广东', '广西', '贵州', '云南', '四川', '宁夏', '海南', '青海', '甘肃', '西藏', '新疆',
	  '台湾', '香港', '澳门', '南海诸岛');
var "mapData": {
		// 一月份数据， 月份名称需与demo中option列表中的data-month值一致
		"Jan": [
			{"name": "北京", "value": 10},
			{"name": "天津", "value": 6},
			{"name": "上海", "value": 6},
			{"name": "重庆", "value": 6},
			{"name": "黑龙江", "value": 6},
			{"name": "吉林", "value": 6},
			{"name": "辽宁", "value": 6},
			{"name": "河北", "value": 9},
			{"name": "山东", "value": 8},
			{"name": "山西", "value": 12},
			{"name": "内蒙古", "value": 6},
			{"name": "河南", "value": 6},
			{"name": "陕西", "value": 6},
			{"name": "湖北", "value": 8},
			{"name": "湖南", "value": 6},
			{"name": "安徽", "value": 6},
			{"name": "江苏", "value": 6},
			{"name": "浙江", "value": 12},
			{"name": "江西", "value": 6},
			{"name": "福建", "value": 6},
			{"name": "广东", "value": 9},
			{"name": "广西", "value": 6},
			{"name": "贵州", "value": 6},
			{"name": "云南", "value": 12},
			{"name": "四川", "value": 6},
			{"name": "宁夏", "value": "-"},		// 对于没有数据的设置为"-"
			{"name": "海南", "value": "-"},
			{"name": "青海", "value": 6},
			{"name": "甘肃", "value": 6},
			{"name": "西藏", "value": "-"},
			{"name": "新疆", "value": "-"},
			{"name": "台湾", "value": "-"},
			{"name": "香港", "value": 9},
			{"name": "澳门", "value": 6},
			// 各月份南海诸岛按以下样式设定，以便将其从地图上除去
			{
"name": "南海诸岛", 
		"value": "-"
			}
		],
		"Feb": [
			{"name": "北京", "value": 10},
			{"name": "天津", "value": 6},
			{"name": "上海", "value": 6},
			{"name": "重庆", "value": 6},
			{"name": "黑龙江", "value": 6},
			{"name": "吉林", "value": 6},
			{"name": "辽宁", "value": 6},
			{"name": "河北", "value": 9},
			{"name": "山东", "value": 8},
			{"name": "山西", "value": 12},
			{"name": "内蒙古", "value": 6},
			{"name": "河南", "value": 6},
			{"name": "陕西", "value": 6},
			{"name": "湖北", "value": 8},
			{"name": "湖南", "value": 6},
			{"name": "安徽", "value": 6},
			{"name": "江苏", "value": 6},
			{"name": "浙江", "value": 12},
			{"name": "江西", "value": 6},
			{"name": "福建", "value": 6},
			{"name": "广东", "value": 9},
			{"name": "广西", "value": 6},
			{"name": "贵州", "value": 6},
			{"name": "云南", "value": 12},
			{"name": "四川", "value": 6},
			{"name": "宁夏", "value": "-"},
			{"name": "海南", "value": "-"},
			{"name": "青海", "value": 6},
			{"name": "甘肃", "value": 6},
			{"name": "西藏", "value": "-"},
			{"name": "新疆", "value": "-"},
			{"name": "台湾", "value": "-"},
			{"name": "香港", "value": 9},
			{"name": "澳门", "value": 6},
			{
"name": "南海诸岛", 
		"value": "-",
			}
		],
		"Aug": [
			{"name": "北京", "value": 11},
			{"name": "天津", "value": 6},
			{"name": "上海", "value": 6},
			{"name": "重庆", "value": 6},
			{"name": "黑龙江", "value": 6},
			{"name": "吉林", "value": 6},
			{"name": "辽宁", "value": 6},
			{"name": "河北", "value": 9},
			{"name": "山东", "value": 8},
			{"name": "山西", "value": 5},
			{"name": "内蒙古", "value": 6},
			{"name": "河南", "value": 6},
			{"name": "陕西", "value": 6},
			{"name": "湖北", "value": 8},
			{"name": "湖南", "value": 6},
			{"name": "安徽", "value": 6},
			{"name": "江苏", "value": 6},
			{"name": "浙江", "value": 12},
			{"name": "江西", "value": 6},
			{"name": "福建", "value": 6},
			{"name": "广东", "value": 9},
			{"name": "广西", "value": 6},
			{"name": "贵州", "value": 6},
			{"name": "云南", "value": 12},
			{"name": "四川", "value": 6},
			{"name": "宁夏", "value": "-"},
			{"name": "海南", "value": "-"},
			{"name": "青海", "value": 6},
			{"name": "甘肃", "value": 12},
			{"name": "西藏", "value": "-"},
			{"name": "新疆", "value": "-"},
			{"name": "台湾", "value": "-"},
			{"name": "香港", "value": 9},
			{"name": "澳门", "value": 6},
			{
"name": "南海诸岛", 
		"value": "-"
			}
		]
	},
"pieData": {
		// 图例
		"type": ["银行", "保险", "其他"],
		// 饼图数据
		"list": [
			{"value": 26, "name": "保险", "status": "未处理","nodeteal":12,"deteal":122},
			{"value": 10, "name": "其他", "status": "未处理","nodeteal":12,"deteal":2},
			{"value": 24, "name": "银行", "status": "已处理","nodeteal":12,"deteal":1}
		]
	}
"lineData":{
		cate:['投诉量','解决量'],
		timecate:['10','20','30'],
		axisCate:{
			'10':['1','2','3','6','7','8','9'],
			'11':['1','2','3','3','6','7','8'],
			'12':['6','7','8','3','6','7','8']
		     },
		list:{
			'10':{
'投诉量':[11, 11, 15, 14, 12, 13, 10],
		 '解决量':[11, 11, 15, 14, 12, 13, 10]
},
	'11':{
'投诉量':[11, 11, 15, 14, 12, 13, 10],
		 '解决量':[11, 11, 15, 14, 12, 13, 10]
},
	'12':{
'投诉量':[11, 11, 15, 14, 12, 13, 10],
		 '解决量':[11, 11, 15, 14, 12, 13, 10]
}
}
	}
