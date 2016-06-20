var divStyle = {
    height: 10
};
var divStyle = {
  color: 'black',
  // backgroundImage: 'url(' + 1 + ')',
  WebkitTransition: 'all', // 注意这里的首字母'W'是大写
  msTransition: 'all' // 'ms'是唯一一个首字母需要小写的浏览器前缀
};
ReactDOM.render(
    <div style={divStyle}>Hello World!</div>,
    document.getElementById('example')
);
