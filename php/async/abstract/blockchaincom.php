<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class blockchaincom extends \ccxt\async\Exchange {
    public function public_get_tickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params);
    }
    public function public_get_tickers_symbol($params = array()) {
        return $this->request('tickers/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_symbols($params = array()) {
        return $this->request('symbols', 'public', 'GET', $params);
    }
    public function public_get_symbols_symbol($params = array()) {
        return $this->request('symbols/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_l2_symbol($params = array()) {
        return $this->request('l2/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_l3_symbol($params = array()) {
        return $this->request('l3/{symbol}', 'public', 'GET', $params);
    }
    public function private_get_fees($params = array()) {
        return $this->request('fees', 'private', 'GET', $params);
    }
    public function private_get_orders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function private_get_orders_orderid($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'GET', $params);
    }
    public function private_get_trades($params = array()) {
        return $this->request('trades', 'private', 'GET', $params);
    }
    public function private_get_fills($params = array()) {
        return $this->request('fills', 'private', 'GET', $params);
    }
    public function private_get_deposits($params = array()) {
        return $this->request('deposits', 'private', 'GET', $params);
    }
    public function private_get_deposits_depositid($params = array()) {
        return $this->request('deposits/{depositId}', 'private', 'GET', $params);
    }
    public function private_get_accounts($params = array()) {
        return $this->request('accounts', 'private', 'GET', $params);
    }
    public function private_get_accounts_account_currency($params = array()) {
        return $this->request('accounts/{account}/{currency}', 'private', 'GET', $params);
    }
    public function private_get_whitelist($params = array()) {
        return $this->request('whitelist', 'private', 'GET', $params);
    }
    public function private_get_whitelist_currency($params = array()) {
        return $this->request('whitelist/{currency}', 'private', 'GET', $params);
    }
    public function private_get_withdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_withdrawalid($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'GET', $params);
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function private_post_deposits_currency($params = array()) {
        return $this->request('deposits/{currency}', 'private', 'POST', $params);
    }
    public function private_post_withdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'POST', $params);
    }
    public function private_delete_orders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params);
    }
    public function private_delete_orders_orderid($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'DELETE', $params);
    }
    public function publicGetTickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params);
    }
    public function publicGetTickersSymbol($params = array()) {
        return $this->request('tickers/{symbol}', 'public', 'GET', $params);
    }
    public function publicGetSymbols($params = array()) {
        return $this->request('symbols', 'public', 'GET', $params);
    }
    public function publicGetSymbolsSymbol($params = array()) {
        return $this->request('symbols/{symbol}', 'public', 'GET', $params);
    }
    public function publicGetL2Symbol($params = array()) {
        return $this->request('l2/{symbol}', 'public', 'GET', $params);
    }
    public function publicGetL3Symbol($params = array()) {
        return $this->request('l3/{symbol}', 'public', 'GET', $params);
    }
    public function privateGetFees($params = array()) {
        return $this->request('fees', 'private', 'GET', $params);
    }
    public function privateGetOrders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function privateGetOrdersOrderId($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'GET', $params);
    }
    public function privateGetTrades($params = array()) {
        return $this->request('trades', 'private', 'GET', $params);
    }
    public function privateGetFills($params = array()) {
        return $this->request('fills', 'private', 'GET', $params);
    }
    public function privateGetDeposits($params = array()) {
        return $this->request('deposits', 'private', 'GET', $params);
    }
    public function privateGetDepositsDepositId($params = array()) {
        return $this->request('deposits/{depositId}', 'private', 'GET', $params);
    }
    public function privateGetAccounts($params = array()) {
        return $this->request('accounts', 'private', 'GET', $params);
    }
    public function privateGetAccountsAccountCurrency($params = array()) {
        return $this->request('accounts/{account}/{currency}', 'private', 'GET', $params);
    }
    public function privateGetWhitelist($params = array()) {
        return $this->request('whitelist', 'private', 'GET', $params);
    }
    public function privateGetWhitelistCurrency($params = array()) {
        return $this->request('whitelist/{currency}', 'private', 'GET', $params);
    }
    public function privateGetWithdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsWithdrawalId($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'GET', $params);
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function privatePostDepositsCurrency($params = array()) {
        return $this->request('deposits/{currency}', 'private', 'POST', $params);
    }
    public function privatePostWithdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'POST', $params);
    }
    public function privateDeleteOrders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrdersOrderId($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'DELETE', $params);
    }
}