
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

var TimerMixin = require('react-timer-mixin');

var API_KEY = '7waqfqbprs7pajbz28mqf6vz';
var API_URL = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json';
var PAGE_SIZE = 20;
var PAGE = 1;
var REQUEST_URL = API_URL + '?apikey=' + API_KEY + '&page_limit=' + PAGE_SIZE + '&page=' + PAGE;

var resultsCache = {
    dataForQuery: {},
    nextPageNumberForQuery: {},
    totalForQuery: {}
};

var LOADING = {};

export default class SearchScreen extends React.Component {
    mixins: [TimerMixin];
    timeoutID: null;
    constructor(props) {
        super(props);
        this.state = {
            dataSource: new ListView.DataSource({
                rowHasChanged: (row1, row2) => row1 !== row2,
            }),
            isLoading: false,
            isRefreshing: false,
            isLoadingTail: false,
            filter: '',
            queryNumber: 0,
        };
    }

    componentDidMount() {
        this.searchMovies('');
    }

    _urlForQueryAndPage(query, pageNumber) {
        return (REQUEST_URL + '&page=' + pageNumber);
    }

    searchMovies(query) {
        this.timeoutID = null;
        this.setState({filter: query});
        var cachedResultsForQuery = resultsCache.dataForQuery[query];
        if (cachedResultsForQuery) {
            if (!LOADING[query]) {
                this.setState({
                    dataSource: this.getDataSource(cachedResultsForQuery),
                    isLoading: false
                });
            } else {
                this.setState({isLoading: true});
            }
            return;
        }

        LOADING[query] = true;
        resultsCache.dataForQuery[query] = null;
        this.setState({
            isLoading: true,
            queryNumber: this.state.queryNumber + 1,
            isLoadingTail: false,
        });

        fetch(this._urlForQueryAndPage(query, 1))
            .then((response) => response.json())
            .catch((error) => {
                LOADING[query] = false;
                resultsCache.dataForQuery[query] = undefined;
                this.setState({
                    dataSource: this.getDataSource([]),
                    isLoading: false,
                });
            })
            .then((responseData) => {
                LOADING[query] = false;

                resultsCache.totalForQuery[query] = responseData.total;
                resultsCache.dataForQuery[query] = responseData.movies;
                resultsCache.nextPageNumberForQuery[query] = 2;

                if (this.state.filter !== query) {
                    // do not update state if the query is stale
                    return;
                }

                this.setState({
                    isLoading: false,
                    dataSource: this.getDataSource(responseData.movies),
                })
            })
            .done();
    }


    getDataSource(movies: Array<any>): ListView.DataSource {
        return this.state.dataSource.cloneWithRows(movies);
    }

    render() {
        if (this.state.isLoading) {
            return this.renderLoadingView();
        }

        return (
            <ListView
                dataSource={this.state.dataSource}
                renderRow={this.renderMovie}
                onEndReached={e=>this.onEndReached(e)}
                renderFooter={e=>this.renderFooter(e)}
                style={styles.listView}
                refreshControl={
                    <RefreshControl
                        refreshing={this.state.isRefreshing}
                        onRefresh={e=>this.onRefresh(e)}
                        tintColor="#ff0000"
                        title="Loading..."
                        colors={['#ff0000', '#00ff00', '#0000ff']}
                        progressBackgroundColor="#ffff00"
                    />
                }
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

    hasMore() {
        var query = this.state.filter;
        if (!resultsCache.dataForQuery[query]) {
            return true;
        }
        return (
            resultsCache.totalForQuery[query] !==
            resultsCache.dataForQuery[query].length
        );
    }

    onRefresh() {
        this.setState({
            isRefreshing: true,
        });

        var query = this.state.filter;
        fetch(this._urlForQueryAndPage(query, 1))
            .then((response) => response.json())
            .catch((error) => {
                LOADING[query] = false;
                resultsCache.dataForQuery[query] = undefined;
                this.setState({
                    dataSource: this.getDataSource([]),
                    isLoading: false,
                });
            })
            .then((responseData) => {
                LOADING[query] = false;

                resultsCache.totalForQuery[query] = responseData.total;
                resultsCache.dataForQuery[query] = responseData.movies;
                resultsCache.nextPageNumberForQuery[query] = 2;

                if (this.state.filter !== query) {
                    // do not update state if the query is stale
                    return;
                }

                this.setState({
                    isLoading: false,
                    isRefreshing: false,
                    dataSource: this.getDataSource(responseData.movies),
                })
            })
            .done();

    }

    onEndReached() {
        var query = this.state.filter;

        // if (!this.hasMore() || this.state.isLoadingTail) {
        if (!this.hasMore()) {
            ToastAndroid.show('没有更多', ToastAndroid.SHORT);
            return;
        }

        if (LOADING[query]) {
            return;
        }

        this.setState({
            queryNumber: this.state.queryNumber + 1,
            isLoadingTail: true,
        });

        var page = resultsCache.nextPageNumberForQuery[query];

        fetch(this._urlForQueryAndPage(query, page))
            .then((response) => response.json())
            .catch((error) => {
                console.error(error);
                LOADING[query] = false;
                this.setState({
                    isLoadingTail: false,
                });
            })
            .then((responseData) => {
                var moviesForQuery = resultsCache.dataForQuery[query].slice();

                LOADING[query] = false;
                // We reached the end of the list before the expected number of results
                if (!responseData.movies) {
                    resultsCache.totalForQuery[query] = moviesForQuery.length;
                } else {
                    for (var i in responseData.movies) {
                        moviesForQuery.push(responseData.movies[i]);
                    }
                    resultsCache.dataForQuery[query] = moviesForQuery;
                    resultsCache.nextPageNumberForQuery[query] += 1;
                }

                if (this.state.filter !== query) {
                    // do not update state if the query is stale
                    return;
                }

                this.setState({
                    isLoadingTail: false,
                    dataSource: this.getDataSource(resultsCache.dataForQuery[query]),
                });
            })
            .done();
    }

    renderFooter() {
        if (!this.hasMore() || !this.state.isLoadingTail) {
            return <View style={styles.scrollSpinner} />;
        }
        if (Platform.OS === 'ios') {
            return <ActivityIndicatorIOS style={styles.scrollSpinner} />;
        } else {
            return (
                <View  style={{alignItems: 'center'}}>
                    <ProgressBarAndroid styleAttr="Large"/>
                </View>
            );
        }
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
  separator: {
    height: 1,
    backgroundColor: '#eeeeee',
  },
  scrollSpinner: {
    marginVertical: 20,
  },
  rowSeparator: {
    backgroundColor: 'rgba(0, 0, 0, 0.1)',
    height: 1,
    marginLeft: 4,
  },
  rowSeparatorHide: {
    opacity: 0.0,
  },
});
