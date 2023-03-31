<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class digifinex extends \ccxt\async\Exchange {
    public function public_spot_get_market_symbols($params = array()) {
        return $this->request('{market}/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_kline($params = array()) {
        return $this->request('kline', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_margin_currencies($params = array()) {
        return $this->request('margin/currencies', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_margin_symbols($params = array()) {
        return $this->request('margin/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_markets($params = array()) {
        return $this->request('markets', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_order_book($params = array()) {
        return $this->request('order_book', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_ping($params = array()) {
        return $this->request('ping', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_spot_symbols($params = array()) {
        return $this->request('spot/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_time($params = array()) {
        return $this->request('time', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_trades($params = array()) {
        return $this->request('trades', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_trades_symbols($params = array()) {
        return $this->request('trades/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_ticker($params = array()) {
        return $this->request('ticker', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_currencies($params = array()) {
        return $this->request('currencies', 'array(public,spot)', 'GET', $params);
    }
    public function public_swap_get_public_api_weight($params = array()) {
        return $this->request('public/api_weight', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_candles($params = array()) {
        return $this->request('public/candles', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_candles_history($params = array()) {
        return $this->request('public/candles_history', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_depth($params = array()) {
        return $this->request('public/depth', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_funding_rate($params = array()) {
        return $this->request('public/funding_rate', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_funding_rate_history($params = array()) {
        return $this->request('public/funding_rate_history', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_instrument($params = array()) {
        return $this->request('public/instrument', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_instruments($params = array()) {
        return $this->request('public/instruments', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_ticker($params = array()) {
        return $this->request('public/ticker', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_tickers($params = array()) {
        return $this->request('public/tickers', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_time($params = array()) {
        return $this->request('public/time', 'array(public,swap)', 'GET', $params);
    }
    public function public_swap_get_public_trades($params = array()) {
        return $this->request('public/trades', 'array(public,swap)', 'GET', $params);
    }
    public function private_spot_get_market_financelog($params = array()) {
        return $this->request('{market}/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_market_mytrades($params = array()) {
        return $this->request('{market}/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_market_order($params = array()) {
        return $this->request('{market}/order', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_market_order_detail($params = array()) {
        return $this->request('{market}/order/detail', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_market_order_current($params = array()) {
        return $this->request('{market}/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_market_order_history($params = array()) {
        return $this->request('{market}/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_assets($params = array()) {
        return $this->request('margin/assets', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_financelog($params = array()) {
        return $this->request('margin/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_mytrades($params = array()) {
        return $this->request('margin/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_order($params = array()) {
        return $this->request('margin/order', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_order_current($params = array()) {
        return $this->request('margin/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_order_history($params = array()) {
        return $this->request('margin/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_margin_positions($params = array()) {
        return $this->request('margin/positions', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_otc_financelog($params = array()) {
        return $this->request('otc/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_assets($params = array()) {
        return $this->request('spot/assets', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_financelog($params = array()) {
        return $this->request('spot/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_mytrades($params = array()) {
        return $this->request('spot/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_order($params = array()) {
        return $this->request('spot/order', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_order_current($params = array()) {
        return $this->request('spot/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_spot_order_history($params = array()) {
        return $this->request('spot/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_deposit_address($params = array()) {
        return $this->request('deposit/address', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_deposit_history($params = array()) {
        return $this->request('deposit/history', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_withdraw_history($params = array()) {
        return $this->request('withdraw/history', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_post_market_order_cancel($params = array()) {
        return $this->request('{market}/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_market_order_new($params = array()) {
        return $this->request('{market}/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_market_order_batch_new($params = array()) {
        return $this->request('{market}/order/batch_new', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_margin_order_cancel($params = array()) {
        return $this->request('margin/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_margin_order_new($params = array()) {
        return $this->request('margin/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_margin_position_close($params = array()) {
        return $this->request('margin/position/close', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_spot_order_cancel($params = array()) {
        return $this->request('spot/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_spot_order_new($params = array()) {
        return $this->request('spot/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_transfer($params = array()) {
        return $this->request('transfer', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_withdraw_new($params = array()) {
        return $this->request('withdraw/new', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_withdraw_cancel($params = array()) {
        return $this->request('withdraw/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function private_swap_get_account_balance($params = array()) {
        return $this->request('account/balance', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_account_positions($params = array()) {
        return $this->request('account/positions', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_account_finance_record($params = array()) {
        return $this->request('account/finance_record', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_account_trading_fee_rate($params = array()) {
        return $this->request('account/trading_fee_rate', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_account_transfer_record($params = array()) {
        return $this->request('account/transfer_record', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_trade_history_orders($params = array()) {
        return $this->request('trade/history_orders', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_trade_history_trades($params = array()) {
        return $this->request('trade/history_trades', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_trade_open_orders($params = array()) {
        return $this->request('trade/open_orders', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_get_trade_order_info($params = array()) {
        return $this->request('trade/order_info', 'array(private,swap)', 'GET', $params);
    }
    public function private_swap_post_account_leverage($params = array()) {
        return $this->request('account/leverage', 'array(private,swap)', 'POST', $params);
    }
    public function private_swap_post_trade_batch_cancel_order($params = array()) {
        return $this->request('trade/batch_cancel_order', 'array(private,swap)', 'POST', $params);
    }
    public function private_swap_post_trade_batch_order($params = array()) {
        return $this->request('trade/batch_order', 'array(private,swap)', 'POST', $params);
    }
    public function private_swap_post_trade_cancel_order($params = array()) {
        return $this->request('trade/cancel_order', 'array(private,swap)', 'POST', $params);
    }
    public function private_swap_post_trade_order_place($params = array()) {
        return $this->request('trade/order_place', 'array(private,swap)', 'POST', $params);
    }
    public function publicSpotGetMarketSymbols($params = array()) {
        return $this->request('{market}/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetKline($params = array()) {
        return $this->request('kline', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarginCurrencies($params = array()) {
        return $this->request('margin/currencies', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarginSymbols($params = array()) {
        return $this->request('margin/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarkets($params = array()) {
        return $this->request('markets', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetOrderBook($params = array()) {
        return $this->request('order_book', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetPing($params = array()) {
        return $this->request('ping', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetSpotSymbols($params = array()) {
        return $this->request('spot/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetTime($params = array()) {
        return $this->request('time', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetTrades($params = array()) {
        return $this->request('trades', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetTradesSymbols($params = array()) {
        return $this->request('trades/symbols', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetTicker($params = array()) {
        return $this->request('ticker', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetCurrencies($params = array()) {
        return $this->request('currencies', 'array(public,spot)', 'GET', $params);
    }
    public function publicSwapGetPublicApiWeight($params = array()) {
        return $this->request('public/api_weight', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicCandles($params = array()) {
        return $this->request('public/candles', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicCandlesHistory($params = array()) {
        return $this->request('public/candles_history', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicDepth($params = array()) {
        return $this->request('public/depth', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicFundingRate($params = array()) {
        return $this->request('public/funding_rate', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicFundingRateHistory($params = array()) {
        return $this->request('public/funding_rate_history', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicInstrument($params = array()) {
        return $this->request('public/instrument', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicInstruments($params = array()) {
        return $this->request('public/instruments', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicTicker($params = array()) {
        return $this->request('public/ticker', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicTickers($params = array()) {
        return $this->request('public/tickers', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicTime($params = array()) {
        return $this->request('public/time', 'array(public,swap)', 'GET', $params);
    }
    public function publicSwapGetPublicTrades($params = array()) {
        return $this->request('public/trades', 'array(public,swap)', 'GET', $params);
    }
    public function privateSpotGetMarketFinancelog($params = array()) {
        return $this->request('{market}/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarketMytrades($params = array()) {
        return $this->request('{market}/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarketOrder($params = array()) {
        return $this->request('{market}/order', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarketOrderDetail($params = array()) {
        return $this->request('{market}/order/detail', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarketOrderCurrent($params = array()) {
        return $this->request('{market}/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarketOrderHistory($params = array()) {
        return $this->request('{market}/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginAssets($params = array()) {
        return $this->request('margin/assets', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginFinancelog($params = array()) {
        return $this->request('margin/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginMytrades($params = array()) {
        return $this->request('margin/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginOrder($params = array()) {
        return $this->request('margin/order', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginOrderCurrent($params = array()) {
        return $this->request('margin/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginOrderHistory($params = array()) {
        return $this->request('margin/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetMarginPositions($params = array()) {
        return $this->request('margin/positions', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetOtcFinancelog($params = array()) {
        return $this->request('otc/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotAssets($params = array()) {
        return $this->request('spot/assets', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotFinancelog($params = array()) {
        return $this->request('spot/financelog', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotMytrades($params = array()) {
        return $this->request('spot/mytrades', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotOrder($params = array()) {
        return $this->request('spot/order', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotOrderCurrent($params = array()) {
        return $this->request('spot/order/current', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetSpotOrderHistory($params = array()) {
        return $this->request('spot/order/history', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetDepositAddress($params = array()) {
        return $this->request('deposit/address', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetDepositHistory($params = array()) {
        return $this->request('deposit/history', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetWithdrawHistory($params = array()) {
        return $this->request('withdraw/history', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotPostMarketOrderCancel($params = array()) {
        return $this->request('{market}/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostMarketOrderNew($params = array()) {
        return $this->request('{market}/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostMarketOrderBatchNew($params = array()) {
        return $this->request('{market}/order/batch_new', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostMarginOrderCancel($params = array()) {
        return $this->request('margin/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostMarginOrderNew($params = array()) {
        return $this->request('margin/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostMarginPositionClose($params = array()) {
        return $this->request('margin/position/close', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostSpotOrderCancel($params = array()) {
        return $this->request('spot/order/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostSpotOrderNew($params = array()) {
        return $this->request('spot/order/new', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTransfer($params = array()) {
        return $this->request('transfer', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostWithdrawNew($params = array()) {
        return $this->request('withdraw/new', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostWithdrawCancel($params = array()) {
        return $this->request('withdraw/cancel', 'array(private,spot)', 'POST', $params);
    }
    public function privateSwapGetAccountBalance($params = array()) {
        return $this->request('account/balance', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetAccountPositions($params = array()) {
        return $this->request('account/positions', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetAccountFinanceRecord($params = array()) {
        return $this->request('account/finance_record', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetAccountTradingFeeRate($params = array()) {
        return $this->request('account/trading_fee_rate', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetAccountTransferRecord($params = array()) {
        return $this->request('account/transfer_record', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetTradeHistoryOrders($params = array()) {
        return $this->request('trade/history_orders', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetTradeHistoryTrades($params = array()) {
        return $this->request('trade/history_trades', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetTradeOpenOrders($params = array()) {
        return $this->request('trade/open_orders', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapGetTradeOrderInfo($params = array()) {
        return $this->request('trade/order_info', 'array(private,swap)', 'GET', $params);
    }
    public function privateSwapPostAccountLeverage($params = array()) {
        return $this->request('account/leverage', 'array(private,swap)', 'POST', $params);
    }
    public function privateSwapPostTradeBatchCancelOrder($params = array()) {
        return $this->request('trade/batch_cancel_order', 'array(private,swap)', 'POST', $params);
    }
    public function privateSwapPostTradeBatchOrder($params = array()) {
        return $this->request('trade/batch_order', 'array(private,swap)', 'POST', $params);
    }
    public function privateSwapPostTradeCancelOrder($params = array()) {
        return $this->request('trade/cancel_order', 'array(private,swap)', 'POST', $params);
    }
    public function privateSwapPostTradeOrderPlace($params = array()) {
        return $this->request('trade/order_place', 'array(private,swap)', 'POST', $params);
    }
}