<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bittrex extends \ccxt\async\Exchange {
    public function public_get_ping($params = array()) {
        return $this->request('ping', 'public', 'GET', $params);
    }
    public function public_get_currencies($params = array()) {
        return $this->request('currencies', 'public', 'GET', $params);
    }
    public function public_get_currencies_symbol($params = array()) {
        return $this->request('currencies/{symbol}', 'public', 'GET', $params);
    }
    public function public_get_markets($params = array()) {
        return $this->request('markets', 'public', 'GET', $params);
    }
    public function public_get_markets_tickers($params = array()) {
        return $this->request('markets/tickers', 'public', 'GET', $params);
    }
    public function public_get_markets_summaries($params = array()) {
        return $this->request('markets/summaries', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol($params = array()) {
        return $this->request('markets/{marketSymbol}', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_summary($params = array()) {
        return $this->request('markets/{marketSymbol}/summary', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_orderbook($params = array()) {
        return $this->request('markets/{marketSymbol}/orderbook', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_trades($params = array()) {
        return $this->request('markets/{marketSymbol}/trades', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_ticker($params = array()) {
        return $this->request('markets/{marketSymbol}/ticker', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_candles_candleinterval_recent($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/recent', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_candles_candleinterval_historical_year_month_day($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}/{month}/{day}', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_candles_candleinterval_historical_year_month($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}/{month}', 'public', 'GET', $params);
    }
    public function public_get_markets_marketsymbol_candles_candleinterval_historical_year($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}', 'public', 'GET', $params);
    }
    public function private_get_account($params = array()) {
        return $this->request('account', 'private', 'GET', $params);
    }
    public function private_get_account_fees_fiat($params = array()) {
        return $this->request('account/fees/fiat', 'private', 'GET', $params);
    }
    public function private_get_account_fees_fiat_currencysymbol($params = array()) {
        return $this->request('account/fees/fiat/{currencySymbol}', 'private', 'GET', $params);
    }
    public function private_get_account_fees_trading($params = array()) {
        return $this->request('account/fees/trading', 'private', 'GET', $params);
    }
    public function private_get_account_fees_trading_marketsymbol($params = array()) {
        return $this->request('account/fees/trading/{marketSymbol}', 'private', 'GET', $params);
    }
    public function private_get_account_volume($params = array()) {
        return $this->request('account/volume', 'private', 'GET', $params);
    }
    public function private_get_account_permissions_markets($params = array()) {
        return $this->request('account/permissions/markets', 'private', 'GET', $params);
    }
    public function private_get_account_permissions_markets_marketsymbol($params = array()) {
        return $this->request('account/permissions/markets/{marketSymbol}', 'private', 'GET', $params);
    }
    public function private_get_account_permissions_currencies($params = array()) {
        return $this->request('account/permissions/currencies', 'private', 'GET', $params);
    }
    public function private_get_account_permissions_currencies_currencysymbol($params = array()) {
        return $this->request('account/permissions/currencies/{currencySymbol}', 'private', 'GET', $params);
    }
    public function private_get_addresses($params = array()) {
        return $this->request('addresses', 'private', 'GET', $params);
    }
    public function private_get_addresses_currencysymbol($params = array()) {
        return $this->request('addresses/{currencySymbol}', 'private', 'GET', $params);
    }
    public function private_get_balances($params = array()) {
        return $this->request('balances', 'private', 'GET', $params);
    }
    public function private_get_balances_currencysymbol($params = array()) {
        return $this->request('balances/{currencySymbol}', 'private', 'GET', $params);
    }
    public function private_get_deposits_open($params = array()) {
        return $this->request('deposits/open', 'private', 'GET', $params);
    }
    public function private_get_deposits_closed($params = array()) {
        return $this->request('deposits/closed', 'private', 'GET', $params);
    }
    public function private_get_deposits_bytxid_txid($params = array()) {
        return $this->request('deposits/ByTxId/{txId}', 'private', 'GET', $params);
    }
    public function private_get_deposits_depositid($params = array()) {
        return $this->request('deposits/{depositId}', 'private', 'GET', $params);
    }
    public function private_get_executions($params = array()) {
        return $this->request('executions', 'private', 'GET', $params);
    }
    public function private_get_executions_last_id($params = array()) {
        return $this->request('executions/last-id', 'private', 'GET', $params);
    }
    public function private_get_executions_executionid($params = array()) {
        return $this->request('executions/{executionId}', 'private', 'GET', $params);
    }
    public function private_get_orders_closed($params = array()) {
        return $this->request('orders/closed', 'private', 'GET', $params);
    }
    public function private_get_orders_open($params = array()) {
        return $this->request('orders/open', 'private', 'GET', $params);
    }
    public function private_get_orders_orderid($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'GET', $params);
    }
    public function private_get_orders_orderid_executions($params = array()) {
        return $this->request('orders/{orderId}/executions', 'private', 'GET', $params);
    }
    public function private_get_ping($params = array()) {
        return $this->request('ping', 'private', 'GET', $params);
    }
    public function private_get_subaccounts_subaccountid($params = array()) {
        return $this->request('subaccounts/{subaccountId}', 'private', 'GET', $params);
    }
    public function private_get_subaccounts($params = array()) {
        return $this->request('subaccounts', 'private', 'GET', $params);
    }
    public function private_get_subaccounts_withdrawals_open($params = array()) {
        return $this->request('subaccounts/withdrawals/open', 'private', 'GET', $params);
    }
    public function private_get_subaccounts_withdrawals_closed($params = array()) {
        return $this->request('subaccounts/withdrawals/closed', 'private', 'GET', $params);
    }
    public function private_get_subaccounts_deposits_open($params = array()) {
        return $this->request('subaccounts/deposits/open', 'private', 'GET', $params);
    }
    public function private_get_subaccounts_deposits_closed($params = array()) {
        return $this->request('subaccounts/deposits/closed', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_open($params = array()) {
        return $this->request('withdrawals/open', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_closed($params = array()) {
        return $this->request('withdrawals/closed', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_bytxid_txid($params = array()) {
        return $this->request('withdrawals/ByTxId/{txId}', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_withdrawalid($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'GET', $params);
    }
    public function private_get_withdrawals_allowed_addresses($params = array()) {
        return $this->request('withdrawals/allowed-addresses', 'private', 'GET', $params);
    }
    public function private_get_conditional_orders_conditionalorderid($params = array()) {
        return $this->request('conditional-orders/{conditionalOrderId}', 'private', 'GET', $params);
    }
    public function private_get_conditional_orders_closed($params = array()) {
        return $this->request('conditional-orders/closed', 'private', 'GET', $params);
    }
    public function private_get_conditional_orders_open($params = array()) {
        return $this->request('conditional-orders/open', 'private', 'GET', $params);
    }
    public function private_get_transfers_sent($params = array()) {
        return $this->request('transfers/sent', 'private', 'GET', $params);
    }
    public function private_get_transfers_received($params = array()) {
        return $this->request('transfers/received', 'private', 'GET', $params);
    }
    public function private_get_transfers_transferid($params = array()) {
        return $this->request('transfers/{transferId}', 'private', 'GET', $params);
    }
    public function private_get_funds_transfer_methods_fundstransfermethodid($params = array()) {
        return $this->request('funds-transfer-methods/{fundsTransferMethodId}', 'private', 'GET', $params);
    }
    public function private_post_addresses($params = array()) {
        return $this->request('addresses', 'private', 'POST', $params);
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function private_post_subaccounts($params = array()) {
        return $this->request('subaccounts', 'private', 'POST', $params);
    }
    public function private_post_withdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'POST', $params);
    }
    public function private_post_conditional_orders($params = array()) {
        return $this->request('conditional-orders', 'private', 'POST', $params);
    }
    public function private_post_transfers($params = array()) {
        return $this->request('transfers', 'private', 'POST', $params);
    }
    public function private_post_batch($params = array()) {
        return $this->request('batch', 'private', 'POST', $params);
    }
    public function private_delete_orders_open($params = array()) {
        return $this->request('orders/open', 'private', 'DELETE', $params);
    }
    public function private_delete_orders_orderid($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'DELETE', $params);
    }
    public function private_delete_withdrawals_withdrawalid($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'DELETE', $params);
    }
    public function private_delete_conditional_orders_conditionalorderid($params = array()) {
        return $this->request('conditional-orders/{conditionalOrderId}', 'private', 'DELETE', $params);
    }
    public function signalr_get_negotiate($params = array()) {
        return $this->request('negotiate', 'signalr', 'GET', $params);
    }
    public function signalr_get_start($params = array()) {
        return $this->request('start', 'signalr', 'GET', $params);
    }
    public function publicGetPing($params = array()) {
        return $this->request('ping', 'public', 'GET', $params);
    }
    public function publicGetCurrencies($params = array()) {
        return $this->request('currencies', 'public', 'GET', $params);
    }
    public function publicGetCurrenciesSymbol($params = array()) {
        return $this->request('currencies/{symbol}', 'public', 'GET', $params);
    }
    public function publicGetMarkets($params = array()) {
        return $this->request('markets', 'public', 'GET', $params);
    }
    public function publicGetMarketsTickers($params = array()) {
        return $this->request('markets/tickers', 'public', 'GET', $params);
    }
    public function publicGetMarketsSummaries($params = array()) {
        return $this->request('markets/summaries', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbol($params = array()) {
        return $this->request('markets/{marketSymbol}', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolSummary($params = array()) {
        return $this->request('markets/{marketSymbol}/summary', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolOrderbook($params = array()) {
        return $this->request('markets/{marketSymbol}/orderbook', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolTrades($params = array()) {
        return $this->request('markets/{marketSymbol}/trades', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolTicker($params = array()) {
        return $this->request('markets/{marketSymbol}/ticker', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolCandlesCandleIntervalRecent($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/recent', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolCandlesCandleIntervalHistoricalYearMonthDay($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}/{month}/{day}', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolCandlesCandleIntervalHistoricalYearMonth($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}/{month}', 'public', 'GET', $params);
    }
    public function publicGetMarketsMarketSymbolCandlesCandleIntervalHistoricalYear($params = array()) {
        return $this->request('markets/{marketSymbol}/candles/{candleInterval}/historical/{year}', 'public', 'GET', $params);
    }
    public function privateGetAccount($params = array()) {
        return $this->request('account', 'private', 'GET', $params);
    }
    public function privateGetAccountFeesFiat($params = array()) {
        return $this->request('account/fees/fiat', 'private', 'GET', $params);
    }
    public function privateGetAccountFeesFiatCurrencySymbol($params = array()) {
        return $this->request('account/fees/fiat/{currencySymbol}', 'private', 'GET', $params);
    }
    public function privateGetAccountFeesTrading($params = array()) {
        return $this->request('account/fees/trading', 'private', 'GET', $params);
    }
    public function privateGetAccountFeesTradingMarketSymbol($params = array()) {
        return $this->request('account/fees/trading/{marketSymbol}', 'private', 'GET', $params);
    }
    public function privateGetAccountVolume($params = array()) {
        return $this->request('account/volume', 'private', 'GET', $params);
    }
    public function privateGetAccountPermissionsMarkets($params = array()) {
        return $this->request('account/permissions/markets', 'private', 'GET', $params);
    }
    public function privateGetAccountPermissionsMarketsMarketSymbol($params = array()) {
        return $this->request('account/permissions/markets/{marketSymbol}', 'private', 'GET', $params);
    }
    public function privateGetAccountPermissionsCurrencies($params = array()) {
        return $this->request('account/permissions/currencies', 'private', 'GET', $params);
    }
    public function privateGetAccountPermissionsCurrenciesCurrencySymbol($params = array()) {
        return $this->request('account/permissions/currencies/{currencySymbol}', 'private', 'GET', $params);
    }
    public function privateGetAddresses($params = array()) {
        return $this->request('addresses', 'private', 'GET', $params);
    }
    public function privateGetAddressesCurrencySymbol($params = array()) {
        return $this->request('addresses/{currencySymbol}', 'private', 'GET', $params);
    }
    public function privateGetBalances($params = array()) {
        return $this->request('balances', 'private', 'GET', $params);
    }
    public function privateGetBalancesCurrencySymbol($params = array()) {
        return $this->request('balances/{currencySymbol}', 'private', 'GET', $params);
    }
    public function privateGetDepositsOpen($params = array()) {
        return $this->request('deposits/open', 'private', 'GET', $params);
    }
    public function privateGetDepositsClosed($params = array()) {
        return $this->request('deposits/closed', 'private', 'GET', $params);
    }
    public function privateGetDepositsByTxIdTxId($params = array()) {
        return $this->request('deposits/ByTxId/{txId}', 'private', 'GET', $params);
    }
    public function privateGetDepositsDepositId($params = array()) {
        return $this->request('deposits/{depositId}', 'private', 'GET', $params);
    }
    public function privateGetExecutions($params = array()) {
        return $this->request('executions', 'private', 'GET', $params);
    }
    public function privateGetExecutionsLastId($params = array()) {
        return $this->request('executions/last-id', 'private', 'GET', $params);
    }
    public function privateGetExecutionsExecutionId($params = array()) {
        return $this->request('executions/{executionId}', 'private', 'GET', $params);
    }
    public function privateGetOrdersClosed($params = array()) {
        return $this->request('orders/closed', 'private', 'GET', $params);
    }
    public function privateGetOrdersOpen($params = array()) {
        return $this->request('orders/open', 'private', 'GET', $params);
    }
    public function privateGetOrdersOrderId($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'GET', $params);
    }
    public function privateGetOrdersOrderIdExecutions($params = array()) {
        return $this->request('orders/{orderId}/executions', 'private', 'GET', $params);
    }
    public function privateGetPing($params = array()) {
        return $this->request('ping', 'private', 'GET', $params);
    }
    public function privateGetSubaccountsSubaccountId($params = array()) {
        return $this->request('subaccounts/{subaccountId}', 'private', 'GET', $params);
    }
    public function privateGetSubaccounts($params = array()) {
        return $this->request('subaccounts', 'private', 'GET', $params);
    }
    public function privateGetSubaccountsWithdrawalsOpen($params = array()) {
        return $this->request('subaccounts/withdrawals/open', 'private', 'GET', $params);
    }
    public function privateGetSubaccountsWithdrawalsClosed($params = array()) {
        return $this->request('subaccounts/withdrawals/closed', 'private', 'GET', $params);
    }
    public function privateGetSubaccountsDepositsOpen($params = array()) {
        return $this->request('subaccounts/deposits/open', 'private', 'GET', $params);
    }
    public function privateGetSubaccountsDepositsClosed($params = array()) {
        return $this->request('subaccounts/deposits/closed', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsOpen($params = array()) {
        return $this->request('withdrawals/open', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsClosed($params = array()) {
        return $this->request('withdrawals/closed', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsByTxIdTxId($params = array()) {
        return $this->request('withdrawals/ByTxId/{txId}', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsWithdrawalId($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'GET', $params);
    }
    public function privateGetWithdrawalsAllowedAddresses($params = array()) {
        return $this->request('withdrawals/allowed-addresses', 'private', 'GET', $params);
    }
    public function privateGetConditionalOrdersConditionalOrderId($params = array()) {
        return $this->request('conditional-orders/{conditionalOrderId}', 'private', 'GET', $params);
    }
    public function privateGetConditionalOrdersClosed($params = array()) {
        return $this->request('conditional-orders/closed', 'private', 'GET', $params);
    }
    public function privateGetConditionalOrdersOpen($params = array()) {
        return $this->request('conditional-orders/open', 'private', 'GET', $params);
    }
    public function privateGetTransfersSent($params = array()) {
        return $this->request('transfers/sent', 'private', 'GET', $params);
    }
    public function privateGetTransfersReceived($params = array()) {
        return $this->request('transfers/received', 'private', 'GET', $params);
    }
    public function privateGetTransfersTransferId($params = array()) {
        return $this->request('transfers/{transferId}', 'private', 'GET', $params);
    }
    public function privateGetFundsTransferMethodsFundsTransferMethodId($params = array()) {
        return $this->request('funds-transfer-methods/{fundsTransferMethodId}', 'private', 'GET', $params);
    }
    public function privatePostAddresses($params = array()) {
        return $this->request('addresses', 'private', 'POST', $params);
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function privatePostSubaccounts($params = array()) {
        return $this->request('subaccounts', 'private', 'POST', $params);
    }
    public function privatePostWithdrawals($params = array()) {
        return $this->request('withdrawals', 'private', 'POST', $params);
    }
    public function privatePostConditionalOrders($params = array()) {
        return $this->request('conditional-orders', 'private', 'POST', $params);
    }
    public function privatePostTransfers($params = array()) {
        return $this->request('transfers', 'private', 'POST', $params);
    }
    public function privatePostBatch($params = array()) {
        return $this->request('batch', 'private', 'POST', $params);
    }
    public function privateDeleteOrdersOpen($params = array()) {
        return $this->request('orders/open', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrdersOrderId($params = array()) {
        return $this->request('orders/{orderId}', 'private', 'DELETE', $params);
    }
    public function privateDeleteWithdrawalsWithdrawalId($params = array()) {
        return $this->request('withdrawals/{withdrawalId}', 'private', 'DELETE', $params);
    }
    public function privateDeleteConditionalOrdersConditionalOrderId($params = array()) {
        return $this->request('conditional-orders/{conditionalOrderId}', 'private', 'DELETE', $params);
    }
    public function signalrGetNegotiate($params = array()) {
        return $this->request('negotiate', 'signalr', 'GET', $params);
    }
    public function signalrGetStart($params = array()) {
        return $this->request('start', 'signalr', 'GET', $params);
    }
}