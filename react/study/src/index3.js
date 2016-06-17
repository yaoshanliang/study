var Hello = React.createClass({
    getInitialState: function() {
        return {name: 'initial state'};
    },
    compentWillMount: function(){
        return {name: 'will mount'};
    },
    componentDidMount: function(){
        return {name: 'did mount'};
    },
    compentWillUpdate: function(){

    },
    componentDidUpdate: function(){

    },
    compentWillUnmount: function(){
    },
    render: function(){
        return <h1>{this.props.name}</h1>;
    }
});
ReactDOM.render(
    <Hello name="iat"/>,
    document.getElementById('example')
);
