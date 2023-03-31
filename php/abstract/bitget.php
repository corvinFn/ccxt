<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitget extends \ccxt\Exchange {
    public function public_spot_get_public_time($params = array()) {
        return $this->request('public/time', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_public_currencies($params = array()) {
        return $this->request('public/currencies', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_public_products($params = array()) {
        return $this->request('public/products', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_public_product($params = array()) {
        return $this->request('public/product', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_ticker($params = array()) {
        return $this->request('market/ticker', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_tickers($params = array()) {
        return $this->request('market/tickers', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_fills($params = array()) {
        return $this->request('market/fills', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_candles($params = array()) {
        return $this->request('market/candles', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_depth($params = array()) {
        return $this->request('market/depth', 'array(public,spot)', 'GET', $params);
    }
    public function public_spot_get_market_spot_vip_level($params = array()) {
        return $this->request('market/spot-vip-level', 'array(public,spot)', 'GET', $params);
    }
    public function public_mix_get_market_contracts($params = array()) {
        return $this->request('market/contracts', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_depth($params = array()) {
        return $this->request('market/depth', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_ticker($params = array()) {
        return $this->request('market/ticker', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_tickers($params = array()) {
        return $this->request('market/tickers', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_fills($params = array()) {
        return $this->request('market/fills', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_candles($params = array()) {
        return $this->request('market/candles', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_index($params = array()) {
        return $this->request('market/index', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_funding_time($params = array()) {
        return $this->request('market/funding-time', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_history_fundrate($params = array()) {
        return $this->request('market/history-fundRate', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_current_fundrate($params = array()) {
        return $this->request('market/current-fundRate', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_open_interest($params = array()) {
        return $this->request('market/open-interest', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_mark_price($params = array()) {
        return $this->request('market/mark-price', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_symbol_leverage($params = array()) {
        return $this->request('market/symbol-leverage', 'array(public,mix)', 'GET', $params);
    }
    public function public_mix_get_market_contract_vip_level($params = array()) {
        return $this->request('market/contract-vip-level', 'array(public,mix)', 'GET', $params);
    }
    public function private_spot_get_account_getinfo($params = array()) {
        return $this->request('account/getInfo', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_account_assets($params = array()) {
        return $this->request('account/assets', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_account_transferrecords($params = array()) {
        return $this->request('account/transferRecords', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_wallet_deposit_address($params = array()) {
        return $this->request('wallet/deposit-address', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_wallet_withdrawal_inner($params = array()) {
        return $this->request('wallet/withdrawal-inner', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_wallet_withdrawal_list($params = array()) {
        return $this->request('wallet/withdrawal-list', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_get_wallet_deposit_list($params = array()) {
        return $this->request('wallet/deposit-list', 'array(private,spot)', 'GET', $params);
    }
    public function private_spot_post_account_bills($params = array()) {
        return $this->request('account/bills', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_account_sub_account_spot_assets($params = array()) {
        return $this->request('account/sub-account-spot-assets', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_orders($params = array()) {
        return $this->request('trade/orders', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_batch_orders($params = array()) {
        return $this->request('trade/batch-orders', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_cancel_order($params = array()) {
        return $this->request('trade/cancel-order', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_cancel_batch_orders($params = array()) {
        return $this->request('trade/cancel-batch-orders', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_cancel_batch_orders_v2($params = array()) {
        return $this->request('trade/cancel-batch-orders-v2', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_orderinfo($params = array()) {
        return $this->request('trade/orderInfo', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_open_orders($params = array()) {
        return $this->request('trade/open-orders', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_history($params = array()) {
        return $this->request('trade/history', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_trade_fills($params = array()) {
        return $this->request('trade/fills', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_wallet_transfer($params = array()) {
        return $this->request('wallet/transfer', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_wallet_withdrawal($params = array()) {
        return $this->request('wallet/withdrawal', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_wallet_subtransfer($params = array()) {
        return $this->request('wallet/subTransfer', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_plan_placeplan($params = array()) {
        return $this->request('plan/placePlan', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_plan_modifyplan($params = array()) {
        return $this->request('plan/modifyPlan', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_plan_cancelplan($params = array()) {
        return $this->request('plan/cancelPlan', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_plan_currentplan($params = array()) {
        return $this->request('plan/currentPlan', 'array(private,spot)', 'POST', $params);
    }
    public function private_spot_post_plan_historyplan($params = array()) {
        return $this->request('plan/historyPlan', 'array(private,spot)', 'POST', $params);
    }
    public function private_mix_get_account_account($params = array()) {
        return $this->request('account/account', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_account_accounts($params = array()) {
        return $this->request('account/accounts', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_account_accountbill($params = array()) {
        return $this->request('account/accountBill', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_account_accountbusinessbill($params = array()) {
        return $this->request('account/accountBusinessBill', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_account_open_count($params = array()) {
        return $this->request('account/open-count', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_current($params = array()) {
        return $this->request('order/current', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_history($params = array()) {
        return $this->request('order/history', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_detail($params = array()) {
        return $this->request('order/detail', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_fills($params = array()) {
        return $this->request('order/fills', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_historyproducttype($params = array()) {
        return $this->request('order/historyProductType', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_allfills($params = array()) {
        return $this->request('order/allFills', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_plan_currentplan($params = array()) {
        return $this->request('plan/currentPlan', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_plan_historyplan($params = array()) {
        return $this->request('plan/historyPlan', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_position_singleposition($params = array()) {
        return $this->request('position/singlePosition', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_position_allposition($params = array()) {
        return $this->request('position/allPosition', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_currenttrack($params = array()) {
        return $this->request('trace/currentTrack', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_followerorder($params = array()) {
        return $this->request('trace/followerOrder', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_historytrack($params = array()) {
        return $this->request('trace/historyTrack', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_summary($params = array()) {
        return $this->request('trace/summary', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_profitsettletokenidgroup($params = array()) {
        return $this->request('trace/profitSettleTokenIdGroup', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_profitdategrouplist($params = array()) {
        return $this->request('trace/profitDateGroupList', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trade_profitdatelist($params = array()) {
        return $this->request('trade/profitDateList', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_waitprofitdatelist($params = array()) {
        return $this->request('trace/waitProfitDateList', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_trace_tradersymbols($params = array()) {
        return $this->request('trace/traderSymbols', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_get_order_margincoincurrent($params = array()) {
        return $this->request('order/marginCoinCurrent', 'array(private,mix)', 'GET', $params);
    }
    public function private_mix_post_account_setleverage($params = array()) {
        return $this->request('account/setLeverage', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_account_setmargin($params = array()) {
        return $this->request('account/setMargin', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_account_setmarginmode($params = array()) {
        return $this->request('account/setMarginMode', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_account_setpositionmode($params = array()) {
        return $this->request('account/setPositionMode', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_order_placeorder($params = array()) {
        return $this->request('order/placeOrder', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_order_batch_orders($params = array()) {
        return $this->request('order/batch-orders', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_order_cancel_order($params = array()) {
        return $this->request('order/cancel-order', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_order_cancel_all_orders($params = array()) {
        return $this->request('order/cancel-all-orders', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_order_cancel_batch_orders($params = array()) {
        return $this->request('order/cancel-batch-orders', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_placeplan($params = array()) {
        return $this->request('plan/placePlan', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_modifyplan($params = array()) {
        return $this->request('plan/modifyPlan', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_modifyplanpreset($params = array()) {
        return $this->request('plan/modifyPlanPreset', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_placetpsl($params = array()) {
        return $this->request('plan/placeTPSL', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_placetrailstop($params = array()) {
        return $this->request('plan/placeTrailStop', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_placepositionstpsl($params = array()) {
        return $this->request('plan/placePositionsTPSL', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_modifytpslplan($params = array()) {
        return $this->request('plan/modifyTPSLPlan', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_cancelplan($params = array()) {
        return $this->request('plan/cancelPlan', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_plan_cancelallplan($params = array()) {
        return $this->request('plan/cancelAllPlan', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_trace_closetrackorder($params = array()) {
        return $this->request('trace/closeTrackOrder', 'array(private,mix)', 'POST', $params);
    }
    public function private_mix_post_trace_setupcopysymbols($params = array()) {
        return $this->request('trace/setUpCopySymbols', 'array(private,mix)', 'POST', $params);
    }
    public function publicSpotGetPublicTime($params = array()) {
        return $this->request('public/time', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetPublicCurrencies($params = array()) {
        return $this->request('public/currencies', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetPublicProducts($params = array()) {
        return $this->request('public/products', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetPublicProduct($params = array()) {
        return $this->request('public/product', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketTicker($params = array()) {
        return $this->request('market/ticker', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketTickers($params = array()) {
        return $this->request('market/tickers', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketFills($params = array()) {
        return $this->request('market/fills', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketCandles($params = array()) {
        return $this->request('market/candles', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketDepth($params = array()) {
        return $this->request('market/depth', 'array(public,spot)', 'GET', $params);
    }
    public function publicSpotGetMarketSpotVipLevel($params = array()) {
        return $this->request('market/spot-vip-level', 'array(public,spot)', 'GET', $params);
    }
    public function publicMixGetMarketContracts($params = array()) {
        return $this->request('market/contracts', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketDepth($params = array()) {
        return $this->request('market/depth', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketTicker($params = array()) {
        return $this->request('market/ticker', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketTickers($params = array()) {
        return $this->request('market/tickers', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketFills($params = array()) {
        return $this->request('market/fills', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketCandles($params = array()) {
        return $this->request('market/candles', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketIndex($params = array()) {
        return $this->request('market/index', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketFundingTime($params = array()) {
        return $this->request('market/funding-time', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketHistoryFundRate($params = array()) {
        return $this->request('market/history-fundRate', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketCurrentFundRate($params = array()) {
        return $this->request('market/current-fundRate', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketOpenInterest($params = array()) {
        return $this->request('market/open-interest', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketMarkPrice($params = array()) {
        return $this->request('market/mark-price', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketSymbolLeverage($params = array()) {
        return $this->request('market/symbol-leverage', 'array(public,mix)', 'GET', $params);
    }
    public function publicMixGetMarketContractVipLevel($params = array()) {
        return $this->request('market/contract-vip-level', 'array(public,mix)', 'GET', $params);
    }
    public function privateSpotGetAccountGetInfo($params = array()) {
        return $this->request('account/getInfo', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetAccountAssets($params = array()) {
        return $this->request('account/assets', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetAccountTransferRecords($params = array()) {
        return $this->request('account/transferRecords', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetWalletDepositAddress($params = array()) {
        return $this->request('wallet/deposit-address', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetWalletWithdrawalInner($params = array()) {
        return $this->request('wallet/withdrawal-inner', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetWalletWithdrawalList($params = array()) {
        return $this->request('wallet/withdrawal-list', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotGetWalletDepositList($params = array()) {
        return $this->request('wallet/deposit-list', 'array(private,spot)', 'GET', $params);
    }
    public function privateSpotPostAccountBills($params = array()) {
        return $this->request('account/bills', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostAccountSubAccountSpotAssets($params = array()) {
        return $this->request('account/sub-account-spot-assets', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeOrders($params = array()) {
        return $this->request('trade/orders', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeBatchOrders($params = array()) {
        return $this->request('trade/batch-orders', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeCancelOrder($params = array()) {
        return $this->request('trade/cancel-order', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeCancelBatchOrders($params = array()) {
        return $this->request('trade/cancel-batch-orders', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeCancelBatchOrdersV2($params = array()) {
        return $this->request('trade/cancel-batch-orders-v2', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeOrderInfo($params = array()) {
        return $this->request('trade/orderInfo', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeOpenOrders($params = array()) {
        return $this->request('trade/open-orders', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeHistory($params = array()) {
        return $this->request('trade/history', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostTradeFills($params = array()) {
        return $this->request('trade/fills', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostWalletTransfer($params = array()) {
        return $this->request('wallet/transfer', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostWalletWithdrawal($params = array()) {
        return $this->request('wallet/withdrawal', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostWalletSubTransfer($params = array()) {
        return $this->request('wallet/subTransfer', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostPlanPlacePlan($params = array()) {
        return $this->request('plan/placePlan', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostPlanModifyPlan($params = array()) {
        return $this->request('plan/modifyPlan', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostPlanCancelPlan($params = array()) {
        return $this->request('plan/cancelPlan', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostPlanCurrentPlan($params = array()) {
        return $this->request('plan/currentPlan', 'array(private,spot)', 'POST', $params);
    }
    public function privateSpotPostPlanHistoryPlan($params = array()) {
        return $this->request('plan/historyPlan', 'array(private,spot)', 'POST', $params);
    }
    public function privateMixGetAccountAccount($params = array()) {
        return $this->request('account/account', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetAccountAccounts($params = array()) {
        return $this->request('account/accounts', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetAccountAccountBill($params = array()) {
        return $this->request('account/accountBill', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetAccountAccountBusinessBill($params = array()) {
        return $this->request('account/accountBusinessBill', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetAccountOpenCount($params = array()) {
        return $this->request('account/open-count', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderCurrent($params = array()) {
        return $this->request('order/current', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderHistory($params = array()) {
        return $this->request('order/history', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderDetail($params = array()) {
        return $this->request('order/detail', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderFills($params = array()) {
        return $this->request('order/fills', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderHistoryProductType($params = array()) {
        return $this->request('order/historyProductType', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderAllFills($params = array()) {
        return $this->request('order/allFills', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetPlanCurrentPlan($params = array()) {
        return $this->request('plan/currentPlan', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetPlanHistoryPlan($params = array()) {
        return $this->request('plan/historyPlan', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetPositionSinglePosition($params = array()) {
        return $this->request('position/singlePosition', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetPositionAllPosition($params = array()) {
        return $this->request('position/allPosition', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceCurrentTrack($params = array()) {
        return $this->request('trace/currentTrack', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceFollowerOrder($params = array()) {
        return $this->request('trace/followerOrder', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceHistoryTrack($params = array()) {
        return $this->request('trace/historyTrack', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceSummary($params = array()) {
        return $this->request('trace/summary', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceProfitSettleTokenIdGroup($params = array()) {
        return $this->request('trace/profitSettleTokenIdGroup', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceProfitDateGroupList($params = array()) {
        return $this->request('trace/profitDateGroupList', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTradeProfitDateList($params = array()) {
        return $this->request('trade/profitDateList', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceWaitProfitDateList($params = array()) {
        return $this->request('trace/waitProfitDateList', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetTraceTraderSymbols($params = array()) {
        return $this->request('trace/traderSymbols', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixGetOrderMarginCoinCurrent($params = array()) {
        return $this->request('order/marginCoinCurrent', 'array(private,mix)', 'GET', $params);
    }
    public function privateMixPostAccountSetLeverage($params = array()) {
        return $this->request('account/setLeverage', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostAccountSetMargin($params = array()) {
        return $this->request('account/setMargin', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostAccountSetMarginMode($params = array()) {
        return $this->request('account/setMarginMode', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostAccountSetPositionMode($params = array()) {
        return $this->request('account/setPositionMode', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostOrderPlaceOrder($params = array()) {
        return $this->request('order/placeOrder', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostOrderBatchOrders($params = array()) {
        return $this->request('order/batch-orders', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostOrderCancelOrder($params = array()) {
        return $this->request('order/cancel-order', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostOrderCancelAllOrders($params = array()) {
        return $this->request('order/cancel-all-orders', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostOrderCancelBatchOrders($params = array()) {
        return $this->request('order/cancel-batch-orders', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanPlacePlan($params = array()) {
        return $this->request('plan/placePlan', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanModifyPlan($params = array()) {
        return $this->request('plan/modifyPlan', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanModifyPlanPreset($params = array()) {
        return $this->request('plan/modifyPlanPreset', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanPlaceTPSL($params = array()) {
        return $this->request('plan/placeTPSL', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanPlaceTrailStop($params = array()) {
        return $this->request('plan/placeTrailStop', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanPlacePositionsTPSL($params = array()) {
        return $this->request('plan/placePositionsTPSL', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanModifyTPSLPlan($params = array()) {
        return $this->request('plan/modifyTPSLPlan', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanCancelPlan($params = array()) {
        return $this->request('plan/cancelPlan', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostPlanCancelAllPlan($params = array()) {
        return $this->request('plan/cancelAllPlan', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostTraceCloseTrackOrder($params = array()) {
        return $this->request('trace/closeTrackOrder', 'array(private,mix)', 'POST', $params);
    }
    public function privateMixPostTraceSetUpCopySymbols($params = array()) {
        return $this->request('trace/setUpCopySymbols', 'array(private,mix)', 'POST', $params);
    }
}