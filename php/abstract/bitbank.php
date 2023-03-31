<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitbank extends \ccxt\Exchange {
    public function public_get_pair_ticker($params = array()) {
        return $this->request('{pair}/ticker', 'public', 'GET', $params);
    }
    public function public_get_pair_depth($params = array()) {
        return $this->request('{pair}/depth', 'public', 'GET', $params);
    }
    public function public_get_pair_transactions($params = array()) {
        return $this->request('{pair}/transactions', 'public', 'GET', $params);
    }
    public function public_get_pair_transactions_yyyymmdd($params = array()) {
        return $this->request('{pair}/transactions/{yyyymmdd}', 'public', 'GET', $params);
    }
    public function public_get_pair_candlestick_candletype_yyyymmdd($params = array()) {
        return $this->request('{pair}/candlestick/{candletype}/{yyyymmdd}', 'public', 'GET', $params);
    }
    public function private_get_user_assets($params = array()) {
        return $this->request('user/assets', 'private', 'GET', $params);
    }
    public function private_get_user_spot_order($params = array()) {
        return $this->request('user/spot/order', 'private', 'GET', $params);
    }
    public function private_get_user_spot_active_orders($params = array()) {
        return $this->request('user/spot/active_orders', 'private', 'GET', $params);
    }
    public function private_get_user_spot_trade_history($params = array()) {
        return $this->request('user/spot/trade_history', 'private', 'GET', $params);
    }
    public function private_get_user_withdrawal_account($params = array()) {
        return $this->request('user/withdrawal_account', 'private', 'GET', $params);
    }
    public function private_post_user_spot_order($params = array()) {
        return $this->request('user/spot/order', 'private', 'POST', $params);
    }
    public function private_post_user_spot_cancel_order($params = array()) {
        return $this->request('user/spot/cancel_order', 'private', 'POST', $params);
    }
    public function private_post_user_spot_cancel_orders($params = array()) {
        return $this->request('user/spot/cancel_orders', 'private', 'POST', $params);
    }
    public function private_post_user_spot_orders_info($params = array()) {
        return $this->request('user/spot/orders_info', 'private', 'POST', $params);
    }
    public function private_post_user_request_withdrawal($params = array()) {
        return $this->request('user/request_withdrawal', 'private', 'POST', $params);
    }
    public function markets_get_spot_pairs($params = array()) {
        return $this->request('spot/pairs', 'markets', 'GET', $params);
    }
    public function publicGetPairTicker($params = array()) {
        return $this->request('{pair}/ticker', 'public', 'GET', $params);
    }
    public function publicGetPairDepth($params = array()) {
        return $this->request('{pair}/depth', 'public', 'GET', $params);
    }
    public function publicGetPairTransactions($params = array()) {
        return $this->request('{pair}/transactions', 'public', 'GET', $params);
    }
    public function publicGetPairTransactionsYyyymmdd($params = array()) {
        return $this->request('{pair}/transactions/{yyyymmdd}', 'public', 'GET', $params);
    }
    public function publicGetPairCandlestickCandletypeYyyymmdd($params = array()) {
        return $this->request('{pair}/candlestick/{candletype}/{yyyymmdd}', 'public', 'GET', $params);
    }
    public function privateGetUserAssets($params = array()) {
        return $this->request('user/assets', 'private', 'GET', $params);
    }
    public function privateGetUserSpotOrder($params = array()) {
        return $this->request('user/spot/order', 'private', 'GET', $params);
    }
    public function privateGetUserSpotActiveOrders($params = array()) {
        return $this->request('user/spot/active_orders', 'private', 'GET', $params);
    }
    public function privateGetUserSpotTradeHistory($params = array()) {
        return $this->request('user/spot/trade_history', 'private', 'GET', $params);
    }
    public function privateGetUserWithdrawalAccount($params = array()) {
        return $this->request('user/withdrawal_account', 'private', 'GET', $params);
    }
    public function privatePostUserSpotOrder($params = array()) {
        return $this->request('user/spot/order', 'private', 'POST', $params);
    }
    public function privatePostUserSpotCancelOrder($params = array()) {
        return $this->request('user/spot/cancel_order', 'private', 'POST', $params);
    }
    public function privatePostUserSpotCancelOrders($params = array()) {
        return $this->request('user/spot/cancel_orders', 'private', 'POST', $params);
    }
    public function privatePostUserSpotOrdersInfo($params = array()) {
        return $this->request('user/spot/orders_info', 'private', 'POST', $params);
    }
    public function privatePostUserRequestWithdrawal($params = array()) {
        return $this->request('user/request_withdrawal', 'private', 'POST', $params);
    }
    public function marketsGetSpotPairs($params = array()) {
        return $this->request('spot/pairs', 'markets', 'GET', $params);
    }
}