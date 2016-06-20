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
  View
} from 'react-native';

var GeolocationExample = React.createClass({
  watchID: (null: ?number),

  getInitialState: function() {
    return {
      initialPosition: 'unknown',
      lastPosition: 'unknown',
    };
  },

  componentDidMount: function() {
    navigator.geolocation.getCurrentPosition(
      (initialPosition) => this.setState({initialPosition}),
      (error) => alert(error.message),
      {enableHighAccuracy: true, timeout: 20000, maximumAge: 1000}
    );
    this.watchID = navigator.geolocation.watchPosition((lastPosition) => {
      this.setState({lastPosition});
    });
  },

  componentWillUnmount: function() {
    navigator.geolocation.clearWatch(this.watchID);
  },

  render: function() {
    return (
      <View>
        <Text>
          <Text style={styles.title}>Initial position: </Text>
          {JSON.stringify(this.state.initialPosition)}
        </Text>
        <Text>
          <Text style={styles.title}>Current position: </Text>
          {JSON.stringify(this.state.lastPosition)}
        </Text>
      </View>
    );
  }
});


var DrawerLayout = React.createClass({
render: function() {
  var navigationView = (
    <View style={{flex: 1, backgroundColor: '#fff'}}>
      <Text style={{margin: 10, fontSize: 15, textAlign: 'left'}}>I'm in the Drawer!</Text>
    </View>
  );
  return (
    <DrawerLayoutAndroid
      drawerWidth={300}
      drawerPosition={DrawerLayoutAndroid.positions.Left}
      renderNavigationView={() => navigationView}>
      <View style={{flex: 1, alignItems: 'center'}}>
        <Text style={{margin: 10, fontSize: 15, textAlign: 'right'}}>Hello</Text>
        <Text style={{margin: 10, fontSize: 15, textAlign: 'right'}}>World!</Text>
      </View>
    </DrawerLayoutAndroid>
  );
},
});

var MyImage = React.createClass({
render: function() {
    return (
        <View>
      <Image style={{width:100, height:100}}
        source={require('./logo_og.png')}>
      <Text>Inside</Text>
      </Image>
      <Image
        source={{uri: 'http://facebook.github.io/react/img/logo_og.png'}}
      />
    </View>
    )
}
});

class study extends Component {
  render() {
      return <MyImage />;
  }
}

AppRegistry.registerComponent('study', () => study);
