/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 * @flow
 */
/* eslint no-console: 0 */
import React, { Component } from 'react';
import {
  AppRegistry,
  StyleSheet,
  DrawerLayoutAndroid,
  Text,
  Image,
  View,
  ListView,
  Platform,
  ActivityIndicatorIOS,
  ProgressBarAndroid,
  Navigator,
  BackAndroid,
  ScrollView,
  RefreshControl,
  TouchableWithoutFeedback,
} from 'react-native';

var API_KEY = '7waqfqbprs7pajbz28mqf6vz';
var API_URL = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json';
var PAGE_SIZE = 25;
var PARAMS = '?apikey=' + API_KEY + '&page_limit=' + PAGE_SIZE;
var REQUEST_URL = API_URL + PARAMS;

class SampleAppMovies extends Component {
  constructor(props) {
    super(props);
    this.state = {
      dataSource: new ListView.DataSource({
        rowHasChanged: (row1, row2) => row1 !== row2,
      }),
      loaded: false,
    };
  }

  componentDidMount() {
    this.fetchData();
  }

  fetchData() {
    fetch(REQUEST_URL)
      .then((response) => response.json())
      .then((responseData) => {
        this.setState({
          dataSource: this.state.dataSource.cloneWithRows(responseData.movies),
          loaded: true,
        });
      })
      .done();
  }

  render() {
    if (!this.state.loaded) {
      return this.renderLoadingView();
    }

    return (
      <ListView
        dataSource={this.state.dataSource}
        renderRow={this.renderMovie}
        style={styles.listView}
      />
    );
  }

  renderLoadingView() {
    return (
      <View style={styles.container}>
        <Text>
          Loading movies!!!!...
        </Text>
      </View>
    );
  }

  renderMovie(movie) {
    return (
      <View style={styles.container}>
        <Image
          source={{uri: movie.posters.thumbnail}}
          style={styles.thumbnail}
        />
        <View style={styles.rightContainer}>
          <Text style={styles.title}>{movie.title}</Text>
          <Text style={styles.year}>{movie.year}</Text>
        </View>
      </View>
    );
  }
};

var styles = StyleSheet.create({
  container: {
    flex: 1,
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
  },
  rightContainer: {
    flex: 1,
  },
  title: {
    fontSize: 20,
    marginBottom: 8,
    textAlign: 'center',
  },
  year: {
    textAlign: 'center',
  },
  thumbnail: {
    width: 53,
    height: 81,
  },
  listView: {
    paddingTop: 20,
    backgroundColor: '#F5FCFF',
  },
});
var SampleApp = React.createClass({

    configureScene(route){
      return Navigator.SceneConfigs.FadeAndroid;
    },

    renderScene(router, navigator){
      var Component = null;this._navigator = navigator;
      switch(router.name){
        case "welcome":
          Component = WelcomeView;
          break;
        case "feed":
          Component = FeedView;
          break;
        default: //default view
          Component = DefaultView;
      }

      return <Component navigator={navigator} />
    },

    componentDidMount() {
      var navigator = this._navigator;
      BackAndroid.addEventListener('hardwareBackPress', function() {
          if (navigator && navigator.getCurrentRoutes().length > 1) {
            navigator.pop();
            return true;
          }
          return false;
      });
    },


    componentWillUnmount() {
      BackAndroid.removeEventListener('hardwareBackPress');
    },

    render() {
        return (
            <Navigator
                initialRoute={{name: 'welcome'}}
                configureScene={this.configureScene}
                renderScene={this.renderScene} />
        );
    }

});
var FeedView = React.createClass({
    goBack(){
      this.props.navigator.push({name:"default"});
    },

    render() {
        return (
            <View style={styles.container}>
                <Text style={styles.welcome} onPress={this.goBack} >
                    I am Feed View! Tab to default view!
                </Text>
            </View>
        )
    }
});


var WelcomeView = React.createClass({
    onPressFeed() {
        this.props.navigator.push({name: 'feed'});
    },


    render() {
        return (
            <View style={styles.container}>
                <Text style={styles.welcome} onPress={this.onPressFeed} >
                    This is welcome view.Tap to go to feed view.
                </Text>
            </View>
        );
    }

});

var DefaultView = React.createClass({

    render(){
      return (
          <View style={styles.container}>
              <Text style={styles.welcome}>Default view</Text>
          </View>
      )
    }
});
const Row = React.createClass({
  _onClick: function() {
    this.props.onClick(this.props.data);
  },
  render: function() {
    return (
     <TouchableWithoutFeedback onPress={this._onClick} >
        <View style={styles.row}>
          <Text style={styles.text}>
            {this.props.data.text + ' (' + this.props.data.clicks + ' clicks)'}
          </Text>
        </View>
      </TouchableWithoutFeedback>
    );
  },
});

const RefreshControlExample = React.createClass({
  statics: {
    title: '<RefreshControl>',
    description: 'Adds pull-to-refresh support to a scrollview.'
  },

  getInitialState() {
    return {
      isRefreshing: false,
      loaded: 0,
      rowData: Array.from(new Array(20)).map(
        (val, i) => ({text: 'Initial row' + i, clicks: 0})),
    };
  },

  _onClick(row) {
    row.clicks++;
    this.setState({
      rowData: this.state.rowData,
    });
  },

  render() {
    const rows = this.state.rowData.map((row, ii) => {
      return <Row key={ii} data={row} onClick={this._onClick}/>;
    });
    return (
      <ScrollView
        style={styles.scrollview}
        refreshControl={
          <RefreshControl
            refreshing={this.state.isRefreshing}
            onRefresh={this._onRefresh}
            tintColor="#ff0000"
            title="Loading..."
            colors={['#ff0000', '#00ff00', '#0000ff']}
            progressBackgroundColor="#ffffff"
          />
        }>
        {rows}
      </ScrollView>
    );
  },

  _onRefresh() {
    this.setState({isRefreshing: true});
    setTimeout(() => {
      // prepend 10 items
      const rowData = Array.from(new Array(10))
      .map((val, i) => ({
        text: 'Loaded row' + (+this.state.loaded + i),
        clicks: 0,
      }))
      .concat(this.state.rowData);

      this.setState({
        loaded: this.state.loaded + 10,
        isRefreshing: false,
        rowData: rowData,
      });
    }, 1);
  },
});

class ScrollViewComponent extends React.Component {
    static defaultProps = {

    };
  constructor(props){
    super(props);
      this.state = {
        isRefreshing: false
      };
    }
  _onRefresh() {
    this.setState({isRefreshing: true});
    setTimeout(() => {
      // prepend 10 items
      const rowData = Array.from(new Array(10))
      .map((val, i) => ({
        text: 'Loaded row' + (+this.state.loaded + i),
        clicks: 0,
      }))
      .concat(this.state.rowData);

      this.setState({
        loaded: this.state.loaded + 10,
        isRefreshing: false,
        rowData: rowData,
      });
    }, 5000)
  }
  render() {
    return (
      <ScrollView
        style={styles.scrollview}
        refreshControl={
          <RefreshControl
            refreshing={this.state.isRefreshing}
            onRefresh={()=>this._onRefresh}
            tintColor="#ff0000"
            title="Loading..."
            colors={['#ff0000', '#00ff00', '#0000ff']}
            progressBackgroundColor="#ffffff"
          />
        }>
        <Text>111</Text>
      </ScrollView>
    );
  }
}

AppRegistry.registerComponent('study', () => ScrollViewComponent);
