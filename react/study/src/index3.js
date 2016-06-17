var Hello = React.createClass({
    getInitialState: function() {
        return {name: 'initial state'};
    },
    compentWillMount: function() {
        this.setState({name: 'will mount'});
    },
    componentDidMount: function() {
        this.setState({name: 'did mount'});
    },
    compentWillUpdate: function() {
        this.setState({name: 'will update'});
    },
    componentDidUpdate: function() {
        this.setState({name: 'did update'});

    },
    compentWillUnmount: function() {
        this.setState({name: 'will unmount'});
    },
    componentWillReceiveProps: function() {
        this.setState({name: 'will receive props'});
    },
    render: function(){
        return <h1>{this.state.name}</h1>;
    }
});
ReactDOM.render(
    <Hello />,
    document.getElementById('example')
);
