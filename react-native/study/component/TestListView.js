
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

export default class TestListView extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            dataSource: new ListView.DataSource({
                rowHasChanged: (row1, row2) => row1 !== row2,
            }),
            isRefreshing: false,
            isLoadingTail: false,
            nextPage: 0,
        };
    }

    componentDidMount() {
        this._genData();
    }

    _genData() {
        var page = this.state.nextPage;
        var data = [];
        for (var i = 0; i < (page + 1) * 40; i++) {
            data.push('Row ' + i);
        }
        this.setState({
            dataSource: this.state.dataSource.cloneWithRows(data),
            nextPage: this.state.nextPage + 1,
        })
    }

    _renderRow(data) {
        return (
            <View>
                <Text>{data}</Text>
            </View>
        );
    }

    _onRefresh() {
        this.setState({
            isRefreshing: true,
        });
    }

    _onEndReached() {
        if (this.state.nextPage > 2) {
            this.setState({
                isLoadingTail: false,
            });
            return;
        }
        this.setState({
            isLoadingTail: true,
        });

        this._genData();
    }

    renderFooter() {
        if (!this.state.isLoadingTail) {
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

    render() {
        console.log(this.state);
        return (
            <ListView
                dataSource={this.state.dataSource}
                renderRow={this._renderRow}
                onEndReached={e=>this._onEndReached(e)}
                renderFooter={e=>this.renderFooter(e)}
                refreshControl={
                    <RefreshControl
                        refreshing={this.state.isRefreshing}
                        onRefresh={e=>this._onRefresh(e)}
                        tintColor="#ff0000"
                        title="Loading..."
                        colors={['#ff0000', '#00ff00', '#0000ff']}
                        progressBackgroundColor="#ffff00"
                    />
                }
            />
        );
    }
}

var styles = StyleSheet.create({
    scrollSpinner: {
        marginVertical: 20,
    },
});
