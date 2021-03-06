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
  ToastAndroid,
} from 'react-native';

// var MovieScreen = require('./MovieScreen');
// import SearchScreen from './SearchScreen';
import SearchScreen from './component/SearchScreen';

var _navigator;
onBackAndroid = () => {
    if (_navigator && _navigator.getCurrentRoutes().length > 1) {
        _navigator.pop();
        return true;
    }
    if (this.lastBackPressed && this.lastBackPressed + 2000 >= Date.now()) {
        return false;
    }
    this.lastBackPressed = Date.now();
    ToastAndroid.show('再按一次退出应用', ToastAndroid.SHORT);
    return true;
};
BackAndroid.addEventListener('hardwareBackPress', this.onBackAndroid);

var RouteMapper = function(route, navigationOperations, onComponentRef) {
    _navigator = navigationOperations;
    if (route.name === 'search') {
        return (
            <SearchScreen navigator={navigationOperations} />
        );
    } else if (route.name === 'movie') {
        return (
            <View style={{flex: 1}}>
                <ToolbarAndroid
                   actions={[]}
                    navIcon={require('image!android_back_white')}
                    onIconClicked={navigationOperations.pop}
                    style={styles.toolbar}
                    titleColor="white"
                    title={route.movie.title}
                />

                <MovieScreen
                    style={{flex: 1}}
                    navigator={navigationOperations}
                    movie={route.movie}
                />
            </View>
        );
    }
};

class MoviesApp extends React.Component {
    render() {
        var initialRoute = {name: 'search'};
        return (
            <Navigator
                style={styles.container}
                initialRoute={initialRoute}
                configureScene={() => Navigator.SceneConfigs.FadeAndroid}
                renderScene={RouteMapper}
            />
        );
    }
}

var styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: 'white',
    },
    toolbar: {
        backgroundColor: '#a9a9a9',
        height: 56,
    },
});

AppRegistry.registerComponent('study', () => MoviesApp);
