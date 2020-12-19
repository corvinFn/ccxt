'use strict';

//  ---------------------------------------------------------------------------

const Exchange = require ('./base/Exchange');
const { BadRequest, InvalidOrder, AuthenticationError, InsufficientFunds, BadSymbol, OrderNotFound } = require ('./base/errors');

//  ---------------------------------------------------------------------------

module.exports = class gopax extends Exchange {
    describe () {
        return this.deepExtend (super.describe (), {
            'id': 'gopax',
            'name': 'Gopax',
            'countries': [ 'KR' ], // South Korea
            'version': 'v1',
            'rateLimit': 50,
            'hostname': 'gopax.co.kr', // or 'gopax.com'
            'has': {
                'cancelOrder': true,
                'createMarketOrder': true,
                'createOrder': true,
                'fetchBalance': true,
                'fetchClosedOrders': true,
                'fetchCurrencies': true,
                'fetchDepositAddress': true,
                'fetchDepositAddresses': true,
                'fetchMarkets': true,
                'fetchMyTrades': true,
                'fetchOHLCV': true,
                'fetchOpenOrders': true,
                'fetchOrder': true,
                'fetchOrderBook': true,
                'fetchOrders': true,
                'fetchTicker': true,
                'fetchTickers': true,
                'fetchTime': true,
                'fetchTrades': true,
                'fetchTransactions': true,
            },
            'timeframes': {
                '1m': '1',
                '5m': '5',
                '30m': '30',
                '1d': '1440',
            },
            'urls': {
                'api': {
                    'public': 'https://api.{hostname}', // or 'https://api.gopax.co.kr'
                    'private': 'https://api.{hostname}',
                },
                'www': 'https://gopax.co.kr/',
                'doc': 'https://gopax.github.io/API/index.en.html',
                'fees': 'https://www.gopax.com/feeinfo',
            },
            'api': {
                'public': {
                    'get': [
                        'assets',
                        'trading-pairs',
                        'trading-pairs/{tradingPair}/ticker',
                        'trading-pairs/{tradingPair}/book',
                        'trading-pairs/{tradingPair}/trades',
                        'trading-pairs/{tradingPair}/stats',
                        'trading-pairs/stats',
                        'trading-pairs/{tradingPair}/candles',
                        'time',
                    ],
                },
                'private': {
                    'get': [
                        'balances',
                        'balances/{assetName}',
                        'orders',
                        'orders/{orderId}',
                        'orders/clientOrderId/{clientOrderId}',
                        'trades',
                        'deposit-withdrawal-status',
                        'crypto-deposit-addresses',
                        'crypto-withdrawal-addresses',
                    ],
                    'post': [
                        'orders',
                    ],
                    'delete': [
                        'orders/{orderId}',
                        'orders/clientOrderId/{clientOrderId}',
                    ],
                },
            },
            'fees': {
                'trading': {
                    'percentage': true,
                    'tierBased': false,
                    'maker': 0.04 / 100,
                    'taker': 0.04 / 100,
                },
            },
            'exceptions': {
                'broad': {
                    'ERROR_INVALID_ORDER_TYPE': InvalidOrder,
                    'ERROR_INVALID_AMOUNT': InvalidOrder,
                    'ERROR_INVALID_TRADING_PAIR': BadSymbol, // Unlikely to be triggered, due to ccxt.gopax.js implementation
                    'No such order ID:': OrderNotFound,
                    'Not enough amount': InsufficientFunds,
                    'Forbidden order type': InvalidOrder,
                    'the client order ID will be reusable which order has already been completed or canceled': InvalidOrder,
                    'ERROR_NO_SUCH_TRADING_PAIR': BadSymbol, // Unlikely to be triggered, due to ccxt.gopax.js implementation
                    'ERROR_INVALID_ORDER_SIDE': InvalidOrder,
                    'ERROR_NOT_HEDGE_TOKEN_USER': InvalidOrder,
                    'ORDER_EVENT_ERROR_NOT_ALLOWED_BID_ORDER': InvalidOrder, // Triggered only when the exchange is locked
                    'ORDER_EVENT_ERROR_INSUFFICIENT_BALANCE': InsufficientFunds,
                    'Invalid option combination': InvalidOrder,
                    'No such client order ID': OrderNotFound,
                },
                'exact': {
                    '10155': AuthenticationError, // {"errorMessage":"Invalid API key","errorCode":10155}
                },
            },
        });
    }

    async fetchTime (params = {}) {
        const response = await this.publicGetTime (params);
        //
        //     {"serverTime":1608327726656}
        //
        return this.safeInteger (response, 'serverTime');
    }

    async fetchMarkets (params = {}) {
        const response = await this.publicGetTradingPairs (params);
        //
        //     [
        //         {
        //             "id":1,
        //             "name":"ETH-KRW",
        //             "baseAsset":"ETH",
        //             "quoteAsset":"KRW",
        //             "baseAssetScale":8,
        //             "quoteAssetScale":0,
        //             "priceMin":1,
        //             "restApiOrderAmountMin":{
        //                 "limitAsk":{"amount":10000,"unit":"KRW"},
        //                 "limitBid":{"amount":10000,"unit":"KRW"},
        //                 "marketAsk":{"amount":0.001,"unit":"ETH"},
        //                 "marketBid":{"amount":10000,"unit":"KRW"},
        //             },
        //             "makerFeePercent":0.2,
        //             "takerFeePercent":0.2,
        //         },
        //     ]
        //
        const results = [];
        for (let i = 0; i < response.length; i++) {
            const market = response[i];
            const id = this.safeString (market, 'name');
            const numericId = this.safeInteger (market, 'id');
            const baseId = this.safeString (market, 'baseAsset');
            const quoteId = this.safeString (market, 'quoteAsset');
            const base = this.safeCurrencyCode (baseId);
            const quote = this.safeCurrencyCode (quoteId);
            const symbol = base + '/' + quote;
            const precision = {
                'price': this.safeInteger (market, 'quoteAssetScale'),
                'amount': this.safeInteger (market, 'baseAssetScale'),
            };
            const minimums = this.safeValue (market, 'restApiOrderAmountMin', {});
            const marketAsk = this.safeValue (minimums, 'marketAsk', {});
            const marketBid = this.safeValue (minimums, 'marketBid', {});
            results.push ({
                'id': id,
                'info': market,
                'numericId': numericId,
                'symbol': symbol,
                'base': base,
                'quote': quote,
                'baseId': this.safeString (market, 'baseAsset'),
                'quoteId': this.safeString (market, 'quoteAsset'),
                'active': true,
                'taker': this.safeFloat (market, 'takerFeePercent'),
                'maker': this.safeFloat (market, 'makerFeePercent'),
                'precision': precision,
                'limits': {
                    'amount': {
                        'min': this.safeFloat (marketAsk, 'amount'),
                        'max': undefined,
                    },
                    'price': {
                        'min': this.safeFloat (market, 'priceMin'),
                        'max': undefined,
                    },
                    'cost': {
                        'min': this.safeFloat (marketBid, 'amount'),
                        'max': undefined,
                    },
                },
            });
        }
        return results;
    }

    async fetchCurrencies (params = {}) {
        const response = await this.publicGetAssets (params);
        //
        //     [
        //         {
        //             "id":"KRW",
        //             "name":"대한민국 원",
        //             "scale":0,
        //             "withdrawalFee":1000,
        //             "withdrawalAmountMin":5000
        //         },
        //         {
        //             "id":"ETH",
        //             "name":"이더리움",
        //             "scale":8,
        //             "withdrawalFee":0.03,
        //             "withdrawalAmountMin":0.015
        //         },
        //     ]
        //
        const results = [];
        for (let i = 0; i < response.length; i++) {
            const currency = response[i];
            const id = this.safeString (currency, 'id');
            const code = this.safeCurrencyCode (id);
            const name = this.safeString (currency, 'name');
            const fee = this.safeFloat (currency, 'withdrawalFee');
            const precision = this.safeFloat (currency, 'scale');
            results.push ({
                'id': id,
                'info': currency,
                'code': code,
                'name': name,
                'active': true,
                'fee': fee,
                'precision': precision,
                'limits': {
                    'amount': {
                        'min': undefined,
                        'max': undefined,
                    },
                    'price': {
                        'min': undefined,
                        'max': undefined,
                    },
                    'cost': {
                        'min': undefined,
                        'max': undefined,
                    },
                    'withdraw': {
                        'min': this.safeFloat (currency, 'withdrawalAmountMin'),
                        'max': undefined,
                    },
                },
            });
        }
        return results;
    }

    async fetchOrderBook (symbol, limit = undefined, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'tradingPair': market['id'],
            // 'level': 3, // 1 best bidask, 2 top 50 bidasks, 3 all bidasks
        };
        const response = await this.publicGetTradingPairsTradingPairBook (this.extend (request, params));
        //
        //     {
        //         "sequence":17691957,
        //         "bid":[
        //             ["17690499",25019000,0.00008904,"1608326468921"],
        //             ["17691894",25010000,0.4295,"1608326499940"],
        //             ["17691895",25009000,0.2359,"1608326499953"],
        //         ],
        //         "ask":[
        //             ["17689176",25024000,0.000098,"1608326442006"],
        //             ["17691351",25031000,0.206,"1608326490418"],
        //             ["17691571",25035000,0.3996,"1608326493742"],
        //         ]
        //     }
        //
        const nonce = this.safeInteger (response, 'sequence');
        const result = this.parseOrderBook (response, undefined, 'bid', 'ask', 1, 2);
        result['nonce'] = nonce;
        return result;
    }

    parseTicker (ticker, market = undefined) {
        //
        // fetchTicker
        //
        //     {
        //         "price":25087000,
        //         "ask":25107000,
        //         "askVolume":0.05837704,
        //         "bid":25087000,
        //         "bidVolume":0.00398628,
        //         "volume":350.09171591,
        //         "quoteVolume":8721016926.06529,
        //         "time":"2020-12-18T21:42:13.774Z",
        //     }
        //
        // fetchTickers
        //
        //     {
        //         "name":"ETH-KRW",
        //         "open":690500,
        //         "high":719500,
        //         "low":681500,
        //         "close":709500,
        //         "volume":2784.6081544,
        //         "time":"2020-12-18T21:54:50.795Z"
        //     }
        //
        const marketId = this.safeString (ticker, 'name');
        const symbol = this.safeSymbol (marketId, market, '-');
        const timestamp = this.parse8601 (this.safeString (ticker, 'time'));
        const open = this.safeFloat (ticker, 'open');
        const last = this.safeFloat2 (ticker, 'price', 'close');
        let change = undefined;
        let percentage = undefined;
        let average = undefined;
        if ((last !== undefined) && (open !== undefined)) {
            average = this.sum (last, open) / 2;
            change = last - open;
            if (open > 0) {
                percentage = change / open * 100;
            }
        }
        const baseVolume = this.safeFloat (ticker, 'volume');
        const quoteVolume = this.safeFloat (ticker, 'quoteVolume');
        const vwap = this.vwap (baseVolume, quoteVolume);
        return {
            'symbol': symbol,
            'info': ticker,
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'high': this.safeFloat (ticker, 'high'),
            'low': this.safeFloat (ticker, 'low'),
            'bid': this.safeFloat (ticker, 'bid'),
            'bidVolume': this.safeFloat (ticker, 'bidVolume'),
            'ask': this.safeFloat (ticker, 'ask'),
            'askVolume': this.safeFloat (ticker, 'askVolume'),
            'vwap': vwap,
            'open': open,
            'close': last,
            'last': last,
            'previousClose': undefined,
            'change': change,
            'percentage': percentage,
            'average': average,
            'baseVolume': baseVolume,
            'quoteVolume': quoteVolume,
        };
    }

    async fetchTicker (symbol, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'tradingPair': market['id'],
        };
        const response = await this.publicGetTradingPairsTradingPairTicker (this.extend (request, params));
        //
        //     {
        //         "price":25087000,
        //         "ask":25107000,
        //         "askVolume":0.05837704,
        //         "bid":25087000,
        //         "bidVolume":0.00398628,
        //         "volume":350.09171591,
        //         "quoteVolume":8721016926.06529,
        //         "time":"2020-12-18T21:42:13.774Z",
        //     }
        //
        return this.parseTicker (response, market);
    }

    parseTickers (rawTickers, symbols = undefined) {
        const tickers = [];
        for (let i = 0; i < rawTickers.length; i++) {
            tickers.push (this.parseTicker (rawTickers[i]));
        }
        return this.filterByArray (tickers, 'symbol', symbols);
    }

    async fetchTickers (symbols = undefined, params = {}) {
        await this.loadMarkets ();
        const response = await this.publicGetTradingPairsStats (params);
        //
        //     [
        //         {
        //             "name":"ETH-KRW",
        //             "open":690500,
        //             "high":719500,
        //             "low":681500,
        //             "close":709500,
        //             "volume":2784.6081544,
        //             "time":"2020-12-18T21:54:50.795Z"
        //         }
        //     ]
        //
        return this.parseTickers (response, symbols);
    }

    parsePublicTrade (trade, market = undefined) {
        const timestamp = this.parse8601 (this.safeString (trade, 'time'));
        const price = this.safeFloat (trade, 'price');
        const amount = this.safeFloat (trade, 'amount');
        let symbol = undefined;
        if ('symbol' in market) {
            symbol = this.safeString (market, 'symbol');
        }
        return {
            'info': trade,
            'id': this.safeString (trade, 'id'),
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'symbol': symbol,
            'order': undefined, // Not mandatory to specify
            'type': undefined, // Not mandatory to specify
            'side': this.safeString (trade, 'side'),
            'takerOrMaker': undefined,
            'price': price,
            'amount': amount,
            'cost': price * amount,
            'fee': undefined,
        };
    }

    parsePrivateTrade (trade, market = undefined) {
        const timestamp = this.parse8601 (this.safeString (trade, 'timestamp'));
        const symbol = this.safeString (trade, 'tradingPairName').replace ('-', '/');
        const side = this.safeString (trade, 'side');
        const price = this.safeFloat (trade, 'price');
        const amount = this.safeFloat (trade, 'baseAmount');
        let feeCurrency = symbol.slice (0, 3);
        if (side === 'sell') {
            feeCurrency = symbol.slice (4);
        }
        const fee = {
            'cost': this.safeFloat (trade, 'fee'),
            'currency': feeCurrency,
            'rate': undefined,
        };
        return {
            'info': trade,
            'id': this.safeString (trade, 'id'),
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'symbol': symbol,
            'order': this.safeInteger (trade, 'orderId'),
            'type': undefined,
            'side': side,
            'takerOrMaker': this.safeString (trade, 'position'),
            'price': price,
            'amount': amount,
            'cost': price * amount,
            'fee': fee,
        };
    }

    parseTrade (trade, market = undefined) {
        //
        // public fetchTrades
        //
        //     {
        //         "time":"2020-12-19T12:17:43.000Z",
        //         "date":1608380263,
        //         "id":23903608,
        //         "price":25155000,
        //         "amount":0.0505,
        //         "side":"sell",
        //     }
        //
        // private fetchMyTrades
        //
        //     ...
        //
        const id = this.safeString (trade, 'id');
        const timestamp = this.parse8601 (this.safeString (trade, 'time'));
        const marketId = undefined;
        const symbol = this.safeSymbol (marketId, market, '-');
        const side = this.safeString (trade, 'side');
        const price = this.safeFloat (trade, 'price');
        const amount = this.safeFloat (trade, 'amount');
        let cost = undefined;
        if ((price !== undefined) && (amount !== undefined)) {
            cost = price * amount;
        }
        return {
            'info': trade,
            'id': id,
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'symbol': symbol,
            'order': this.safeInteger (trade, 'orderId'),
            'type': undefined,
            'side': side,
            'takerOrMaker': this.safeString (trade, 'position'),
            'price': price,
            'amount': amount,
            'cost': cost,
            'fee': undefined,
        };
    }

    async fetchTrades (symbol, since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'tradingPair': market['id'],
            // 'limit': limit,
            // 'pastmax': id, // read data older than this ID
            // 'latestmin': id, // read data newer than this ID
            // 'after': parseInt (since / 1000),
            // 'before': this.seconds (),
        };
        if (since !== undefined) {
            request['after'] = parseInt (since / 1000);
        }
        if (limit !== undefined) {
            request['limit'] = limit;
        }
        const response = await this.publicGetTradingPairsTradingPairTrades (this.extend (request, params));
        //
        //     [
        //         {"time":"2020-12-19T12:17:43.000Z","date":1608380263,"id":23903608,"price":25155000,"amount":0.0505,"side":"sell"},
        //         {"time":"2020-12-19T12:17:13.000Z","date":1608380233,"id":23903604,"price":25140000,"amount":0.019,"side":"sell"},
        //         {"time":"2020-12-19T12:16:49.000Z","date":1608380209,"id":23903599,"price":25140000,"amount":0.0072,"side":"sell"},
        //     ]
        //
        return this.parseTrades (response, market, since, limit);
    }

    parseOHLCV (ohlcv, market = undefined) {
        //
        //     [
        //         1606780800000, // timestamp
        //         21293000,      // low
        //         21300000,      // high
        //         21294000,      // open
        //         21300000,      // close
        //         1.019126,      // volume
        //     ]
        //
        return [
            this.safeInteger (ohlcv, 0),
            this.safeFloat (ohlcv, 3),
            this.safeFloat (ohlcv, 2),
            this.safeFloat (ohlcv, 1),
            this.safeFloat (ohlcv, 4),
            this.safeFloat (ohlcv, 5),
        ];
    }

    async fetchOHLCV (symbol, timeframe = '1m', since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        limit = (limit === undefined) ? 1024 : limit; // default 1024
        const request = {
            'tradingPair': market['id'],
            // 'start': since,
            // 'end': this.milliseconds (),
            'interval': this.timeframes[timeframe],
        };
        const duration = this.parseTimeframe (timeframe);
        if (since === undefined) {
            const end = this.milliseconds ();
            request['end'] = end;
            request['start'] = end - limit * duration * 1000;
        } else {
            request['start'] = since;
            request['end'] = this.sum (since, limit * duration * 1000);
        }
        const response = await this.publicGetTradingPairsTradingPairCandles (this.extend (request, params));
        //
        //     [
        //         [1606780800000,21293000,21300000,21294000,21300000,1.019126],
        //         [1606780860000,21237000,21293000,21293000,21263000,0.96800057],
        //         [1606780920000,21240000,21240000,21240000,21240000,0.11068715],
        //     ]
        //
        return this.parseOHLCVs (response, market, timeframe, since, limit);
    }

    async fetchBalance (params = {}) {
        const response = await this.privateGetBalances (params);
        const result = { 'info': response };
        for (let i = 0; i < response.length; i++) {
            const currency = this.safeString (response[i], 'asset');
            const freeAmount = this.safeFloat (response[i], 'avail');
            const usedAmount = this.sum (this.safeFloat (response[i], 'hold'), this.safeFloat (response[i], 'pendingWithdrawal'));
            result[currency] = {
                'free': freeAmount,
                'used': usedAmount,
                'total': this.sum (freeAmount, usedAmount),
            };
        }
        return this.parseBalance (result);
    }

    parseOrder (order, market = undefined) {
        const datetime = this.safeString (order, 'createdAt');
        const gopaxStatus = this.safeString (order, 'status');
        let status = 'open';
        if (gopaxStatus === 'cancelled') {
            status = 'canceled';
        } else if (gopaxStatus === 'completed') {
            status = 'closed';
        }
        const price = this.safeFloat (order, 'price');
        const amount = this.safeFloat (order, 'amount');
        const remaining = this.safeFloat (order, 'remaining');
        const filled = amount - remaining;
        const side = this.safeString (order, 'side');
        const symbol = this.safeString (order, 'tradingPairName').replace ('-', '/');
        const balanceChange = this.safeValue (order, 'balanceChange');
        let timeInForce = this.safeString (order, 'timeInForce');
        if (timeInForce !== undefined) {
            timeInForce = timeInForce.toUpperCase ();
        }
        const fee = {};
        if (side === 'buy') {
            const baseFee = this.safeValue (balanceChange, 'baseFee');
            fee['currency'] = symbol.slice (0, 3);
            fee['cost'] = this.sum (Math.abs (this.safeFloat (baseFee, 'taking')), Math.abs (this.safeFloat (baseFee, 'making')));
        } else {
            const quoteFee = this.safeValue (balanceChange, 'quoteFee');
            fee['currency'] = symbol.slice (4);
            fee['cost'] = this.sum (Math.abs (this.safeFloat (quoteFee, 'taking')), Math.abs (this.safeFloat (quoteFee, 'making')));
        }
        return {
            'id': this.safeString (order, 'id'),
            'clientOrderId': this.safeString (order, 'clientOrderId'),
            'datetime': datetime,
            'timestamp': this.parse8601 (datetime),
            'lastTradeTimestamp': this.parse8601 (this.safeString (order, 'updatedAt')),
            'status': status,
            'symbol': symbol,
            'type': this.safeString (order, 'type'),
            'timeInForce': timeInForce,
            'side': side,
            'price': price,
            'average': price,
            'amount': amount,
            'filled': filled,
            'remaining': remaining,
            'cost': filled * price,
            'trades': undefined,
            'fee': fee,
            'info': order,
        };
    }

    async fetchOrder (id, symbol = undefined, params = {}) {
        let response = undefined;
        if ('ClientOrderId' in params) {
            response = await this.privateGetOrdersClientOrderIdClientOrderId (params);
        } else {
            const request = {
                'orderId': id,
            };
            response = await this.privateGetOrdersOrderId (this.extend (request, params));
        }
        return this.parseOrder (response);
    }

    async fetchOrders (symbol = undefined, since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        let market = undefined;
        if (symbol !== undefined) {
            market = this.market (symbol);
        }
        if (!('includePast' in params)) {
            params['includePast'] = 'true';
        }
        const response = await this.privateGetOrders (params);
        return this.parseOrders (response, market, since, limit);
    }

    async fetchOpenOrders (symbol = undefined, since = undefined, limit = undefined, params = {}) {
        return await this.fetchOrders (symbol, since, limit, { 'includePast': false });
    }

    async fetchClosedOrders (symbol = undefined, since = undefined, limit = undefined, params = {}) {
        const allOrders = await this.fetchOrders (symbol, since, undefined);
        const closedOrders = [];
        for (let i = 0; i < allOrders.length; i++) {
            if (this.safeString (allOrders[i], 'status') === 'closed') {
                closedOrders.push (allOrders[i]);
                if (limit !== undefined && closedOrders.length === limit) {
                    break;
                }
            }
        }
        return closedOrders;
    }

    async createOrder (symbol, type, side, amount, price = undefined, params = {}) {
        // Initial error handling
        if (type !== 'market' && type !== 'limit') {
            throw new InvalidOrder ('ERROR_INVALID_ORDER_TYPE');
        }
        if (side !== 'buy' && side !== 'sell') {
            throw new InvalidOrder ('ERROR_INVALID_ORDER_SIDE');
        }
        await this.loadMarkets ();
        const market = this.market (symbol);
        const tradingPairName = this.safeString (market, 'symbol').replace ('/', '-');
        const request = {
            'tradingPairName': tradingPairName,
            'side': side,
            'type': type,
            'price': price,
            'amount': amount,
        };
        if ('clientOrderId' in params) {
            const clientOrderId = this.safeInteger (params, 'clientOrderId');
            if (clientOrderId !== undefined) {
                request['clientOrderId'] = clientOrderId;
            }
        }
        if ('stopPrice' in params) {
            const stopPrice = this.safeFloat (params, 'stopPrice');
            if (stopPrice !== undefined) {
                request['stopPrice'] = stopPrice;
            }
        }
        if ('protection' in params) {
            const protection = this.safeString (params, 'protection');
            if (protection !== undefined) {
                request['protection'] = protection;
            }
        }
        if ('timeInForce' in params) {
            const timeInForce = this.safeString (params, 'timeInForce');
            if (timeInForce !== undefined) {
                request['timeInForce'] = timeInForce;
            }
        }
        const response = await this.privatePostOrders (this.extend (request, params));
        return this.parseOrder (response);
    }

    async cancelOrder (id, symbol = undefined, params = {}) {
        if ('ClientOrderId' in params) {
            await this.privateDeleteOrdersClientOrderIdClientOrderId (params);
        } else {
            const request = {
                'orderId': id,
            };
            await this.privateDeleteOrdersOrderId (this.extend (request, params));
        }
    }

    async fetchMyTrades (symbol = undefined, since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        let market = undefined;
        if (symbol !== undefined) {
            market = this.market (symbol);
        }
        const request = {};
        if (since !== undefined) {
            if (since > this.milliseconds ()) {
                throw new BadRequest ('Starting time should be in the past.');
            }
            request['after'] = Math.floor (since / 1000.0);
        }
        if (limit !== undefined && symbol === undefined) {
            if (limit <= 0) {
                throw new BadRequest ('Limit should be a positive number.');
            }
            request['limit'] = limit;
        }
        const response = await this.privateGetTrades (this.extend (request, params));
        return this.parseTrades (response, market, since, limit);
    }

    async fetchDepositAddresses (codes = undefined, params = {}) {
        const response = await this.privateGetCryptoDepositAddresses (params);
        const addresses = [];
        const codesObj = {};
        if (codes !== undefined) {
            for (let i = 0; i < codes.length; i++) {
                codesObj[codes[i]] = true;
            }
        }
        for (let i = 0; i < response.length; i++) {
            const currency = this.safeString (response[i], 'asset');
            if (codes === undefined || (currency in codesObj)) {
                addresses.push ({
                    'currency': currency,
                    'address': this.safeString (response[i], 'address'),
                    'tag': this.safeString (response[i], 'memoId'),
                    'info': response[i],
                });
            }
        }
        return addresses;
    }

    async fetchDepositAddress (code, params = {}) {
        await this.loadMarkets ();
        const currency = this.safeString (this.safeCurrency (code), 'code');
        const addresses = await this.fetchDepositAddresses ([currency], params);
        if (addresses.length === 0) {
            throw new BadRequest ('No deposit address found');
        }
        return addresses[0];
    }

    parseTransaction (transaction, currency = undefined) {
        const gopaxType = this.safeString (transaction, 'type');
        let type = 'deposit';
        if (gopaxType === 'crypto_withdrawal' || gopaxType === 'fiat_withdrawal') {
            type = 'withdrawal';
        }
        const amount = this.safeFloat (transaction, 'netAmount');
        const fee = this.safeFloat (transaction, 'feeAmount');
        let rate = 0;
        if (fee !== undefined && amount !== undefined && amount !== 0) {
            rate = fee / amount;
        }
        const timestamp = this.safeInteger (transaction, 'reviewStartedAt') * 1000;
        let updated = timestamp;
        if ('completedAt' in transaction) {
            const updatedAt = this.safeInteger (transaction, 'completedAt');
            if (updatedAt) {
                updated = updatedAt * 1000;
            }
        }
        let code = this.safeString (transaction, 'asset');
        if (!code) {
            code = currency.code;
        }
        return {
            'info': transaction,
            'id': this.safeInteger (transaction, 'id'),
            'txid': this.safeString (transaction, 'txId'),
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'addressFrom': this.safeString (transaction, 'sourceAddress'),
            'address': undefined,
            'addressTo': this.safeString (transaction, 'destinationAddress'),
            'tagFrom': this.safeString (transaction, 'sourceMemoId'),
            'tag': undefined,
            'tagTo': this.safeString (transaction, 'destinationMemoId'),
            'type': type,
            'amount': amount,
            'currency': code,
            'status': this.safeString (transaction, 'status'),
            'updated': updated,
            'comment': undefined,
            'fee': {
                'currency': code,
                'cost': fee,
                'rate': rate,
            },
        };
    }

    async fetchDeposits (code = undefined, since = undefined, limit = undefined, params = {}) {
        const transactions = await this.fetchTransactions (code, since, limit, params);
        const deposits = [];
        for (let i = 0; i < transactions.length; i++) {
            const type = this.safeString (transactions[i], 'type');
            if (type === 'deposit') {
                deposits.push (transactions[i]);
            }
        }
        return deposits;
    }

    async fetchWithdrawals (code = undefined, since = undefined, limit = undefined, params = {}) {
        const transactions = await this.fetchTransactions (code, since, limit, params);
        const withdrawals = [];
        for (let i = 0; i < transactions.length; i++) {
            const type = this.safeString (transactions[i], 'type');
            if (type === 'withdrawal') {
                withdrawals.push (transactions[i]);
            }
        }
        return withdrawals;
    }

    async fetchTransactions (code = undefined, since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        // Invalid request handling
        if (since !== undefined && since > this.milliseconds ()) {
            throw new BadRequest ('Starting time should be in the past.');
        }
        if (limit !== undefined && limit <= 0) {
            throw new BadRequest ('Limit should be a positive integer.');
        }
        const request = {};
        if (since !== undefined) {
            request['after'] = since;
        }
        if (code === undefined) {
            request['limit'] = limit;
        }
        const response = await this.privateGetDepositWithdrawalStatus (this.extend (request, params));
        let currency = undefined;
        if (code !== undefined) {
            currency = this.safeCurrency (code.toLowerCase ());
        }
        return this.parseTransactions (response, currency, since, limit, params);
    }

    sign (path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) { // for authentication in private API calls
        const endpoint = '/' + this.implodeParams (path, params);
        let url = this.implodeParams (this.urls['api'][api], { 'hostname': this.hostname }) + endpoint;
        const query = this.omit (params, this.extractParams (path));
        if (api === 'public') {
            if (Object.keys (query).length) {
                url += '?' + this.urlencode (query);
            }
        } else if (api === 'private') {
            this.checkRequiredCredentials ();
            const timestamp = this.nonce ().toString ();
            let auth = 't' + timestamp + method + endpoint;
            if (method === 'POST') {
                headers['Content-Type'] = 'application/json';
                body = this.json (params);
                auth += body;
            } else if (endpoint === '/orders') {
                if (Object.keys (query).length) {
                    auth += '?' + this.urlencode (query);
                }
            }
            const rawSecret = this.base64ToBinary (this.secret);
            const signature = this.hmac (this.encode (auth), rawSecret, 'sha512', 'base64');
            headers = {
                'api-key': this.apiKey,
                'timestamp': timestamp,
                'signature': signature,
            };
        }
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }

    nonce () {
        return this.milliseconds ();
    }

    handleErrors (code, reason, url, method, headers, body, response, requestHeaders, requestBody) {
        if (response === undefined) {
            return;
        }
        //
        //     {"errorMessage":"Invalid API key","errorCode":10155}
        //
        if (!Array.isArray (response)) {
            const errorCode = this.safeString (response, 'errorCode');
            const errorMessage = this.safeString (response, 'errorMessage');
            if (errorCode !== undefined) {
                const feedback = this.id + ' ' + body;
                this.throwExactlyMatchedException (this.exceptions['exact'], errorCode, feedback);
            } else if (errorMessage !== undefined) {
                const feedback = this.id + ' ' + body;
                this.throwBroadlyMatchedException (this.exceptions['broad'], body, feedback);
            }
        }
    }
};
