# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxtpro.base.exchange import Exchange
import ccxt.async_support as ccxt
from ccxtpro.base.cache import ArrayCache, ArrayCacheBySymbolById, ArrayCacheByTimestamp
from ccxt.base.errors import ExchangeError
from ccxt.base.errors import NetworkError
from ccxt.base.errors import InvalidNonce


class kucoin(Exchange, ccxt.kucoin):

    def describe(self):
        return self.deep_extend(super(kucoin, self).describe(), {
            'has': {
                'ws': True,
                'watchOrderBook': True,
                'watchOrders': True,
                'watchMyTrades': True,
                'watchTickers': False,  # for now
                'watchTicker': True,
                'watchTrades': True,
                'watchBalance': True,
                'watchOHLCV': True,
            },
            'options': {
                'tradesLimit': 1000,
                'watchOrderBookRate': 100,  # get updates every 100ms or 1000ms
                'fetchOrderBookSnapshot': {
                    'maxAttempts': 3,  # default number of sync attempts
                    'delay': 1000,  # warmup delay in ms before synchronizing
                },
                'watchTicker': {
                    'topic': 'market/snapshot',  # market/ticker
                },
            },
            'streaming': {
                # kucoin does not support built-in ws protocol-level ping-pong
                # instead it requires a custom json-based text ping-pong
                # https://docs.kucoin.com/#ping
                'ping': self.ping,
            },
        })

    async def negotiate(self, params={}):
        client = self.client('ws')
        messageHash = 'negotiate'
        future = self.safe_value(client.subscriptions, messageHash)
        if future is None:
            future = client.future(messageHash)
            client.subscriptions[messageHash] = future
            response = None
            throwException = False
            if self.check_required_credentials(throwException):
                response = await self.privatePostBulletPrivate()
                #
                #     {
                #         code: "200000",
                #         data: {
                #             instanceServers: [
                #                 {
                #                     pingInterval:  50000,
                #                     endpoint: "wss://push-private.kucoin.com/endpoint",
                #                     protocol: "websocket",
                #                     encrypt: True,
                #                     pingTimeout: 10000
                #                 }
                #             ],
                #             token: "2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ1UQy47YbpY4zVdzilNP-Bj3iXzrjjGlWtiYB9J6i9GjsxUuhPw3BlrzazF6ghq4Lzf7scStOz3KkxjwpsOBCH4=.WNQmhZQeUKIkh97KYgU0Lg=="
                #         }
                #     }
                #
            else:
                response = await self.publicPostBulletPublic()
            client.resolve(response, messageHash)
            # data = self.safe_value(response, 'data', {})
            # instanceServers = self.safe_value(data, 'instanceServers', [])
            # firstServer = self.safe_value(instanceServers, 0, {})
            # endpoint = self.safe_string(firstServer, 'endpoint')
            # token = self.safe_string(data, 'token')
        return await future

    def request_id(self):
        requestId = self.sum(self.safe_integer(self.options, 'requestId', 0), 1)
        self.options['requestId'] = requestId
        return requestId

    async def subscribe(self, negotiation, topic, messageHash, method, symbol, params={}):
        await self.load_markets()
        # market = self.market(symbol)
        data = self.safe_value(negotiation, 'data', {})
        instanceServers = self.safe_value(data, 'instanceServers', [])
        firstServer = self.safe_value(instanceServers, 0, {})
        endpoint = self.safe_string(firstServer, 'endpoint')
        token = self.safe_string(data, 'token')
        nonce = self.request_id()
        query = {
            'token': token,
            'acceptUserMessage': 'true',
            # 'connectId': nonce,  # user-defined id is supported, received by handleSystemStatus
        }
        url = endpoint + '?' + self.urlencode(query)
        # topic = '/market/snapshot'  # '/market/ticker'
        # messageHash = topic + ':' + market['id']
        subscribe = {
            'id': nonce,
            'type': 'subscribe',
            'topic': topic,
            'response': True,
        }
        subscription = {
            'id': str(nonce),
            'symbol': symbol,
            'topic': topic,
            'messageHash': messageHash,
            'method': method,
        }
        request = self.extend(subscribe, params)
        subscriptionHash = topic
        return await self.watch(url, messageHash, request, subscriptionHash, subscription)

    async def watch_ticker(self, symbol, params={}):
        await self.load_markets()
        market = self.market(symbol)
        negotiation = await self.negotiate()
        options = self.safe_value(self.options, 'watchTicker', {})
        channel = self.safe_string(options, 'topic', 'market/snapshot')
        topic = '/' + channel + ':' + market['id']
        messageHash = topic
        return await self.subscribe(negotiation, topic, messageHash, None, symbol, params)

    def handle_ticker(self, client, message):
        #
        # market/snapshot
        #
        # updates come in every 2 sec unless there
        # were no changes since the previous update
        #
        #     {
        #         "data": {
        #             "sequence": "1545896669291",
        #             "data": {
        #                 "trading": True,
        #                 "symbol": "KCS-BTC",
        #                 "buy": 0.00011,
        #                 "sell": 0.00012,
        #                 "sort": 100,
        #                 "volValue": 3.13851792584,  # total
        #                 "baseCurrency": "KCS",
        #                 "market": "BTC",
        #                 "quoteCurrency": "BTC",
        #                 "symbolCode": "KCS-BTC",
        #                 "datetime": 1548388122031,
        #                 "high": 0.00013,
        #                 "vol": 27514.34842,
        #                 "low": 0.0001,
        #                 "changePrice": -1.0e-5,
        #                 "changeRate": -0.0769,
        #                 "lastTradedPrice": 0.00012,
        #                 "board": 0,
        #                 "mark": 0
        #             }
        #         },
        #         "subject": "trade.snapshot",
        #         "topic": "/market/snapshot:KCS-BTC",
        #         "type": "message"
        #     }
        #
        # market/ticker
        #
        #     {
        #         type: 'message',
        #         topic: '/market/ticker:BTC-USDT',
        #         subject: 'trade.ticker',
        #         data: {
        #             bestAsk: '62163',
        #             bestAskSize: '0.99011388',
        #             bestBid: '62162.9',
        #             bestBidSize: '0.04794181',
        #             price: '62162.9',
        #             sequence: '1621383371852',
        #             size: '0.00832274',
        #             time: 1634641987564
        #         }
        #     }
        #
        topic = self.safe_string(message, 'topic')
        market = None
        if topic is not None:
            parts = topic.split(':')
            marketId = self.safe_string(parts, 1)
            market = self.safe_market(marketId, market, '-')
        data = self.safe_value(message, 'data', {})
        rawTicker = self.safe_value(data, 'data', data)
        ticker = self.parse_ticker(rawTicker, market)
        symbol = ticker['symbol']
        self.tickers[symbol] = ticker
        messageHash = self.safe_string(message, 'topic')
        if messageHash is not None:
            client.resolve(ticker, messageHash)
        return message

    async def watch_ohlcv(self, symbol, timeframe='1m', since=None, limit=None, params={}):
        await self.load_markets()
        negotiation = await self.negotiate()
        market = self.market(symbol)
        period = self.timeframes[timeframe]
        topic = '/market/candles:' + market['id'] + '_' + period
        messageHash = topic
        ohlcv = await self.subscribe(negotiation, topic, messageHash, None, symbol, params)
        if self.newUpdates:
            limit = ohlcv.getLimit(symbol, limit)
        return self.filter_by_since_limit(ohlcv, since, limit, 0, True)

    def handle_ohlcv(self, client, message):
        #
        #     {
        #         data: {
        #             symbol: 'BTC-USDT',
        #             candles: [
        #                 '1624881240',
        #                 '34138.8',
        #                 '34121.6',
        #                 '34138.8',
        #                 '34097.9',
        #                 '3.06097133',
        #                 '104430.955068564'
        #             ],
        #             time: 1624881284466023700
        #         },
        #         subject: 'trade.candles.update',
        #         topic: '/market/candles:BTC-USDT_1min',
        #         type: 'message'
        #     }
        #
        data = self.safe_value(message, 'data', {})
        marketId = self.safe_string(data, 'symbol')
        candles = self.safe_value(data, 'candles', [])
        topic = self.safe_string(message, 'topic')
        parts = topic.split('_')
        interval = self.safe_string(parts, 1)
        # use a reverse lookup in a static map instead
        timeframe = self.find_timeframe(interval)
        symbol = self.safe_symbol(marketId)
        market = self.market(symbol)
        self.ohlcvs[symbol] = self.safe_value(self.ohlcvs, symbol, {})
        stored = self.safe_value(self.ohlcvs[symbol], timeframe)
        if stored is None:
            limit = self.safe_integer(self.options, 'OHLCVLimit', 1000)
            stored = ArrayCacheByTimestamp(limit)
            self.ohlcvs[symbol][timeframe] = stored
        ohlcv = self.parse_ohlcv(candles, market)
        stored.append(ohlcv)
        client.resolve(stored, topic)

    async def watch_trades(self, symbol, since=None, limit=None, params={}):
        await self.load_markets()
        negotiation = await self.negotiate()
        market = self.market(symbol)
        topic = '/market/match:' + market['id']
        messageHash = topic
        trades = await self.subscribe(negotiation, topic, messageHash, None, symbol, params)
        if self.newUpdates:
            limit = trades.getLimit(symbol, limit)
        return self.filter_by_since_limit(trades, since, limit, 'timestamp', True)

    def handle_trade(self, client, message):
        #
        #     {
        #         data: {
        #             sequence: '1568787654360',
        #             symbol: 'BTC-USDT',
        #             side: 'buy',
        #             size: '0.00536577',
        #             price: '9345',
        #             takerOrderId: '5e356c4a9f1a790008f8d921',
        #             time: '1580559434436443257',
        #             type: 'match',
        #             makerOrderId: '5e356bffedf0010008fa5d7f',
        #             tradeId: '5e356c4aeefabd62c62a1ece'
        #         },
        #         subject: 'trade.l3match',
        #         topic: '/market/match:BTC-USDT',
        #         type: 'message'
        #     }
        #
        data = self.safe_value(message, 'data', {})
        trade = self.parse_trade(data)
        messageHash = self.safe_string(message, 'topic')
        symbol = trade['symbol']
        trades = self.safe_value(self.trades, symbol)
        if trades is None:
            limit = self.safe_integer(self.options, 'tradesLimit', 1000)
            trades = ArrayCache(limit)
            self.trades[symbol] = trades
        trades.append(trade)
        client.resolve(trades, messageHash)
        return message

    async def watch_order_book(self, symbol, limit=None, params={}):
        #
        # https://docs.kucoin.com/#level-2-market-data
        #
        # 1. After receiving the websocket Level 2 data flow, cache the data.
        # 2. Initiate a REST request to get the snapshot data of Level 2 order book.
        # 3. Playback the cached Level 2 data flow.
        # 4. Apply the new Level 2 data flow to the local snapshot to ensure that
        # the sequence of the new Level 2 update lines up with the sequence of
        # the previous Level 2 data. Discard all the message prior to that
        # sequence, and then playback the change to snapshot.
        # 5. Update the level2 full data based on sequence according to the
        # size. If the price is 0, ignore the messages and update the sequence.
        # If the size=0, update the sequence and remove the price of which the
        # size is 0 out of level 2. For other cases, please update the price.
        #
        if limit is not None:
            if (limit != 20) and (limit != 100):
                raise ExchangeError(self.id + " watchOrderBook 'limit' argument must be None, 20 or 100")
        await self.load_markets()
        negotiation = await self.negotiate()
        market = self.market(symbol)
        topic = '/market/level2:' + market['id']
        messageHash = topic
        orderbook = await self.subscribe(negotiation, topic, messageHash, self.handle_order_book_subscription, symbol, params)
        return orderbook.limit(limit)

    def retry_fetch_order_book_snapshot(self, client, message, subscription):
        symbol = self.safe_string(subscription, 'symbol')
        messageHash = self.safe_string(subscription, 'messageHash')
        # print('fetchOrderBookSnapshot', nonce, previousSequence, nonce >= previousSequence)
        options = self.safe_value(self.options, 'fetchOrderBookSnapshot', {})
        maxAttempts = self.safe_integer(options, 'maxAttempts', 3)
        numAttempts = self.safe_integer(subscription, 'numAttempts', 0)
        # retry to syncrhonize if we haven't reached maxAttempts yet
        if numAttempts < maxAttempts:
            # safety guard
            if messageHash in client.subscriptions:
                numAttempts = self.sum(numAttempts, 1)
                subscription['numAttempts'] = numAttempts
                client.subscriptions[messageHash] = subscription
                self.spawn(self.fetch_order_book_snapshot, client, message, subscription)
        else:
            if messageHash in client.subscriptions:
                subscription['fetchingOrderBookSnapshot'] = False
                subscription['numAttempts'] = 0
                client.subscriptions[messageHash] = subscription
            e = InvalidNonce(self.id + ' failed to synchronize WebSocket feed with the snapshot for symbol ' + symbol + ' in ' + str(maxAttempts) + ' attempts')
            client.reject(e, messageHash)

    async def fetch_order_book_snapshot(self, client, message, subscription):
        symbol = self.safe_string(subscription, 'symbol')
        limit = self.safe_integer(subscription, 'limit')
        messageHash = self.safe_string(subscription, 'messageHash')
        try:
            # 2. Initiate a REST request to get the snapshot data of Level 2 order book.
            # todo: self is a synch blocking call in ccxt.php - make it async
            snapshot = await self.fetch_order_book(symbol, limit)
            orderbook = self.orderbooks[symbol]
            messages = orderbook.cache
            # make sure we have at least one delta before fetching the snapshot
            # otherwise we cannot synchronize the feed with the snapshot
            # and that will lead to a bidask cross as reported here
            # https://github.com/ccxt/ccxt/issues/6762
            firstMessage = self.safe_value(messages, 0, {})
            data = self.safe_value(firstMessage, 'data', {})
            sequenceStart = self.safe_integer(data, 'sequenceStart')
            nonce = self.safe_integer(snapshot, 'nonce')
            previousSequence = sequenceStart - 1
            # if the received snapshot is earlier than the first cached delta
            # then we cannot align it with the cached deltas and we need to
            # retry synchronizing in maxAttempts
            if nonce < previousSequence:
                self.retry_fetch_order_book_snapshot(client, message, subscription)
            else:
                orderbook.reset(snapshot)
                # unroll the accumulated deltas
                # 3. Playback the cached Level 2 data flow.
                for i in range(0, len(messages)):
                    message = messages[i]
                    self.handle_order_book_message(client, message, orderbook)
                self.orderbooks[symbol] = orderbook
                client.resolve(orderbook, messageHash)
        except Exception as e:
            if isinstance(e, NetworkError):
                self.retry_fetch_order_book_snapshot(client, message, subscription)
            else:
                client.reject(e, messageHash)

    def handle_delta(self, bookside, delta, nonce):
        price = self.safe_float(delta, 0)
        if price > 0:
            sequence = self.safe_integer(delta, 2)
            if sequence > nonce:
                amount = self.safe_float(delta, 1)
                bookside.store(price, amount)

    def handle_deltas(self, bookside, deltas, nonce):
        for i in range(0, len(deltas)):
            self.handle_delta(bookside, deltas[i], nonce)

    def handle_order_book_message(self, client, message, orderbook):
        #
        #     {
        #         "type":"message",
        #         "topic":"/market/level2:BTC-USDT",
        #         "subject":"trade.l2update",
        #         "data":{
        #             "sequenceStart":1545896669105,
        #             "sequenceEnd":1545896669106,
        #             "symbol":"BTC-USDT",
        #             "changes": {
        #                 "asks": [["6","1","1545896669105"]],  # price, size, sequence
        #                 "bids": [["4","1","1545896669106"]]
        #             }
        #         }
        #     }
        #
        data = self.safe_value(message, 'data', {})
        sequenceEnd = self.safe_integer(data, 'sequenceEnd')
        # 4. Apply the new Level 2 data flow to the local snapshot to ensure that
        # the sequence of the new Level 2 update lines up with the sequence of
        # the previous Level 2 data. Discard all the message prior to that
        # sequence, and then playback the change to snapshot.
        if sequenceEnd > orderbook['nonce']:
            sequenceStart = self.safe_integer(message, 'sequenceStart')
            if (sequenceStart is not None) and ((sequenceStart - 1) > orderbook['nonce']):
                # todo: client.reject from handleOrderBookMessage properly
                raise ExchangeError(self.id + ' handleOrderBook received an out-of-order nonce')
            changes = self.safe_value(data, 'changes', {})
            asks = self.safe_value(changes, 'asks', [])
            bids = self.safe_value(changes, 'bids', [])
            asks = self.sort_by(asks, 2)  # sort by sequence
            bids = self.sort_by(bids, 2)
            # 5. Update the level2 full data based on sequence according to the
            # size. If the price is 0, ignore the messages and update the sequence.
            # If the size=0, update the sequence and remove the price of which the
            # size is 0 out of level 2. For other cases, please update the price.
            self.handle_deltas(orderbook['asks'], asks, orderbook['nonce'])
            self.handle_deltas(orderbook['bids'], bids, orderbook['nonce'])
            orderbook['nonce'] = sequenceEnd
            orderbook['timestamp'] = None
            orderbook['datetime'] = None
        return orderbook

    def handle_order_book(self, client, message):
        #
        # initial snapshot is fetched with ccxt's fetchOrderBook
        # the feed does not include a snapshot, just the deltas
        #
        #     {
        #         "type":"message",
        #         "topic":"/market/level2:BTC-USDT",
        #         "subject":"trade.l2update",
        #         "data":{
        #             "sequenceStart":1545896669105,
        #             "sequenceEnd":1545896669106,
        #             "symbol":"BTC-USDT",
        #             "changes": {
        #                 "asks": [["6","1","1545896669105"]],  # price, size, sequence
        #                 "bids": [["4","1","1545896669106"]]
        #             }
        #         }
        #     }
        #
        messageHash = self.safe_string(message, 'topic')
        data = self.safe_value(message, 'data')
        marketId = self.safe_string(data, 'symbol')
        symbol = self.safe_symbol(marketId, None, '-')
        orderbook = self.orderbooks[symbol]
        if orderbook['nonce'] is None:
            subscription = self.safe_value(client.subscriptions, messageHash)
            fetchingOrderBookSnapshot = self.safe_value(subscription, 'fetchingOrderBookSnapshot')
            if fetchingOrderBookSnapshot is None:
                subscription['fetchingOrderBookSnapshot'] = True
                client.subscriptions[messageHash] = subscription
                options = self.safe_value(self.options, 'fetchOrderBookSnapshot', {})
                delay = self.safe_integer(options, 'delay', self.rateLimit)
                # fetch the snapshot in a separate async call after a warmup delay
                self.delay(delay, self.fetch_order_book_snapshot, client, message, subscription)
            # 1. After receiving the websocket Level 2 data flow, cache the data.
            orderbook.cache.append(message)
        else:
            self.handle_order_book_message(client, message, orderbook)
            client.resolve(orderbook, messageHash)

    def handle_order_book_subscription(self, client, message, subscription):
        symbol = self.safe_string(subscription, 'symbol')
        limit = self.safe_string(subscription, 'limit')
        if symbol in self.orderbooks:
            del self.orderbooks[symbol]
        self.orderbooks[symbol] = self.order_book({}, limit)
        # moved snapshot initialization to handleOrderBook to fix
        # https://github.com/ccxt/ccxt/issues/6820
        # the general idea is to fetch the snapshot after the first delta
        # but not before, because otherwise we cannot synchronize the feed

    def handle_subscription_status(self, client, message):
        #
        #     {
        #         id: '1578090438322',
        #         type: 'ack'
        #     }
        #
        id = self.safe_string(message, 'id')
        subscriptionsById = self.index_by(client.subscriptions, 'id')
        subscription = self.safe_value(subscriptionsById, id, {})
        method = self.safe_value(subscription, 'method')
        if method is not None:
            method(client, message, subscription)
        return message

    def handle_system_status(self, client, message):
        #
        # todo: answer the question whether handleSystemStatus should be renamed
        # and unified as handleStatus for any usage pattern that
        # involves system status and maintenance updates
        #
        #     {
        #         id: '1578090234088',  # connectId
        #         type: 'welcome',
        #     }
        #
        return message

    async def watch_orders(self, symbol=None, since=None, limit=None, params={}):
        await self.load_markets()
        negotiation = await self.negotiate()
        topic = '/spotMarket/tradeOrders'
        request = {
            'privateChannel': True,
        }
        messageHash = topic
        if symbol is not None:
            market = self.market(symbol)
            messageHash = messageHash + ':' + market['symbol']
        orders = await self.subscribe(negotiation, topic, messageHash, None, None, self.extend(request, params))
        if self.newUpdates:
            limit = orders.getLimit(symbol, limit)
        return self.filter_by_symbol_since_limit(orders, symbol, since, limit, True)

    def parse_ws_order_status(self, status):
        statuses = {
            'open': 'open',
            'filled': 'closed',
            'match': 'closed',
            'update': 'open',
            'canceled': 'canceled',
        }
        return self.safe_string(statuses, status, status)

    def parse_ws_order(self, order, market=None):
        #
        #     {
        #         'symbol': 'XCAD-USDT',
        #         'orderType': 'limit',
        #         'side': 'buy',
        #         'orderId': '6249167327218b000135e749',
        #         'type': 'canceled',
        #         'orderTime': 1648957043065280224,
        #         'size': '100.452',
        #         'filledSize': '0',
        #         'price': '2.9635',
        #         'clientOid': 'buy-XCAD-USDT-1648957043010159',
        #         'remainSize': '0',
        #         'status': 'done',
        #         'ts': 1648957054031001037
        #     }
        #
        id = self.safe_string(order, 'orderId')
        clientOrderId = self.safe_string(order, 'clientOid')
        orderType = self.safe_string_lower(order, 'orderType')
        price = self.safe_string(order, 'price')
        filled = self.safe_string(order, 'filledSize')
        amount = self.safe_string(order, 'size')
        rawType = self.safe_string(order, 'type')
        status = self.parse_ws_order_status(rawType)
        timestamp = self.safe_integer_product(order, 'orderTime', 0.000001)
        marketId = self.safe_string(order, 'symbol')
        market = self.safe_market(marketId, market)
        symbol = market['symbol']
        side = self.safe_string_lower(order, 'side')
        return self.safe_order({
            'info': order,
            'symbol': symbol,
            'id': id,
            'clientOrderId': clientOrderId,
            'timestamp': timestamp,
            'datetime': self.iso8601(timestamp),
            'lastTradeTimestamp': None,
            'type': orderType,
            'timeInForce': None,
            'postOnly': None,
            'side': side,
            'price': price,
            'stopPrice': None,
            'amount': amount,
            'cost': None,
            'average': None,
            'filled': filled,
            'remaining': None,
            'status': status,
            'fee': None,
            'trades': None,
        }, market)

    def handle_order(self, client, message):
        messageHash = '/spotMarket/tradeOrders'
        data = self.safe_value(message, 'data')
        parsed = self.parse_ws_order(data)
        symbol = self.safe_string(parsed, 'symbol')
        orderId = self.safe_string(parsed, 'id')
        if symbol is not None:
            if self.orders is None:
                limit = self.safe_integer(self.options, 'ordersLimit', 1000)
                self.orders = ArrayCacheBySymbolById(limit)
            cachedOrders = self.orders
            orders = self.safe_value(cachedOrders.hashmap, symbol, {})
            order = self.safe_value(orders, orderId)
            if order is not None:
                # todo add others to calculate average etc
                stopPrice = self.safe_value(order, 'stopPrice')
                if stopPrice is not None:
                    parsed['stopPrice'] = stopPrice
                if order['status'] == 'closed':
                    parsed['status'] = 'closed'
            cachedOrders.append(parsed)
            client.resolve(self.orders, messageHash)
            symbolSpecificMessageHash = messageHash + ':' + symbol
            client.resolve(self.orders, symbolSpecificMessageHash)

    async def watch_my_trades(self, symbol=None, since=None, limit=None, params={}):
        await self.load_markets()
        negotiation = await self.negotiate()
        topic = '/spot/tradeFills'
        request = {
            'privateChannel': True,
        }
        messageHash = topic
        if symbol is not None:
            market = self.market(symbol)
            messageHash = messageHash + ':' + market['symbol']
        trades = await self.subscribe(negotiation, topic, messageHash, None, None, self.extend(request, params))
        if self.newUpdates:
            limit = trades.getLimit(symbol, limit)
        return self.filter_by_symbol_since_limit(trades, symbol, since, limit)

    def handle_my_trade(self, client, message):
        trades = self.myTrades
        if trades is None:
            limit = self.safe_integer(self.options, 'tradesLimit', 1000)
            trades = ArrayCacheBySymbolById(limit)
        data = self.safe_value(message, 'data')
        parsed = self.parse_ws_trade(data)
        trades.append(parsed)
        messageHash = '/spot/tradeFills'
        client.resolve(trades, messageHash)
        symbolSpecificMessageHash = messageHash + ':' + parsed['symbol']
        client.resolve(trades, symbolSpecificMessageHash)

    def parse_ws_trade(self, trade, market=None):
        #
        # {
        #     fee: 0.00262148,
        #     feeCurrency: 'USDT',
        #     feeRate: 0.001,
        #     orderId: '62417436b29df8000183df2f',
        #     orderType: 'market',
        #     price: 131.074,
        #     side: 'sell',
        #     size: 0.02,
        #     symbol: 'LTC-USDT',
        #     time: '1648456758734571745',
        #     tradeId: '624174362e113d2f467b3043'
        #   }
        #
        marketId = self.safe_string(trade, 'symbol')
        market = self.safe_market(marketId, market, '-')
        symbol = market['symbol']
        type = self.safe_string(trade, 'orderType')
        side = self.safe_string(trade, 'side')
        tradeId = self.safe_string(trade, 'tradeId')
        price = self.safe_string(trade, 'price')
        amount = self.safe_string(trade, 'size')
        order = self.safe_string(trade, 'orderId')
        timestamp = self.safe_integer_product(trade, 'time', 0.000001)
        feeCurrency = market['quote']
        feeRate = self.safe_string(trade, 'feeRate')
        fee = {
            'cost': None,
            'rate': feeRate,
            'currency': feeCurrency,
        }
        return self.safe_trade({
            'info': trade,
            'timestamp': timestamp,
            'datetime': self.iso8601(timestamp),
            'symbol': symbol,
            'id': tradeId,
            'order': order,
            'type': type,
            'takerOrMaker': None,
            'side': side,
            'price': price,
            'amount': amount,
            'cost': None,
            'fee': fee,
        }, market)

    async def watch_balance(self, params={}):
        await self.load_markets()
        negotiation = await self.negotiate()
        topic = '/account/balance'
        request = {
            'privateChannel': True,
        }
        messageHash = topic
        return await self.subscribe(negotiation, topic, messageHash, self.handle_balance_subscription, None, self.extend(request, params))

    def handle_balance(self, client, message):
        #
        # {
        #     "id":"6217a451294b030001e3a26a",
        #     "type":"message",
        #     "topic":"/account/balance",
        #     "userId":"6217707c52f97f00012a67db",
        #     "channelType":"private",
        #     "subject":"account.balance",
        #     "data":{
        #        "accountId":"62177fe67810720001db2f18",
        #        "available":"89",
        #        "availableChange":"-30",
        #        "currency":"USDT",
        #        "hold":"0",
        #        "holdChange":"0",
        #        "relationContext":{
        #        },
        #        "relationEvent":"main.transfer",
        #        "relationEventId":"6217a451294b030001e3a26a",
        #        "time":"1645716561816",
        #        "total":"89"
        #     }
        #
        data = self.safe_value(message, 'data', {})
        messageHash = self.safe_string(message, 'topic')
        currencyId = self.safe_string(data, 'currency')
        relationEvent = self.safe_string(data, 'relationEvent')
        requestAccountType = None
        if relationEvent is not None:
            relationEventParts = relationEvent.split('.')
            requestAccountType = self.safe_string(relationEventParts, 0)
        selectedType = self.safe_string_2(self.options, 'watchBalance', 'defaultType', 'trade')  # trade, main, margin or other
        accountsByType = self.safe_value(self.options, 'accountsByType')
        uniformType = self.safe_string(accountsByType, requestAccountType, 'trade')
        if not (uniformType in self.balance):
            self.balance[uniformType] = {}
        code = self.safe_currency_code(currencyId)
        account = self.account()
        account['free'] = self.safe_string(data, 'available')
        account['used'] = self.safe_string(data, 'hold')
        account['total'] = self.safe_string(data, 'total')
        self.balance[uniformType][code] = account
        self.balance[uniformType] = self.safe_balance(self.balance[uniformType])
        if uniformType == selectedType:
            client.resolve(self.balance[uniformType], messageHash)

    def handle_balance_subscription(self, client, message, subscription):
        self.spawn(self.fetch_balance_snapshot, client, message)

    async def fetch_balance_snapshot(self, client, message):
        await self.load_markets()
        self.check_required_credentials()
        messageHash = '/account/balance'
        selectedType = self.safe_string_2(self.options, 'watchBalance', 'defaultType', 'spot')  # spot, margin, main, funding, future, mining, trade, contract, pool
        params = {
            'type': selectedType,
        }
        snapshot = await self.fetch_balance(params)
        #
        # {
        #     "info":{
        #        "code":"200000",
        #        "data":[
        #           {
        #              "id":"6217a451cbe8910001ed3aa8",
        #              "currency":"USDT",
        #              "type":"trade",
        #              "balance":"10",
        #              "available":"4.995",
        #              "holds":"5.005"
        #           }
        #        ]
        #     },
        #     "USDT":{
        #        "free":4.995,
        #        "used":5.005,
        #        "total":10
        #     },
        #     "free":{
        #        "USDT":4.995
        #     },
        #     "used":{
        #        "USDT":5.005
        #     },
        #     "total":{
        #        "USDT":10
        #     }
        #  }
        #
        data = self.safe_value(snapshot['info'], 'data', [])
        if len(data) > 0:
            selectedType = self.safe_string_2(self.options, 'watchBalance', 'defaultType', 'trade')  # trade, main, margin or other
            for i in range(0, len(data)):
                balance = data[i]
                type = self.safe_string(balance, 'type')
                accountsByType = self.safe_value(self.options, 'accountsByType')
                uniformType = self.safe_string(accountsByType, type, 'trade')
                if not (uniformType in self.balance):
                    self.balance[uniformType] = {}
                currencyId = self.safe_string(balance, 'currency')
                code = self.safe_currency_code(currencyId)
                account = self.account()
                account['free'] = self.safe_string(balance, 'available')
                account['used'] = self.safe_string(balance, 'holds')
                account['total'] = self.safe_string(balance, 'total')
                self.balance[selectedType][code] = account
                self.balance[selectedType] = self.safe_balance(self.balance[selectedType])
            client.resolve(self.balance[selectedType], messageHash)

    def handle_subject(self, client, message):
        #
        #     {
        #         "type":"message",
        #         "topic":"/market/level2:BTC-USDT",
        #         "subject":"trade.l2update",
        #         "data":{
        #             "sequenceStart":1545896669105,
        #             "sequenceEnd":1545896669106,
        #             "symbol":"BTC-USDT",
        #             "changes": {
        #                 "asks": [["6","1","1545896669105"]],  # price, size, sequence
        #                 "bids": [["4","1","1545896669106"]]
        #             }
        #         }
        #     }
        #
        subject = self.safe_string(message, 'subject')
        methods = {
            'trade.l2update': self.handle_order_book,
            'trade.ticker': self.handle_ticker,
            'trade.snapshot': self.handle_ticker,
            'trade.l3match': self.handle_trade,
            'trade.candles.update': self.handle_ohlcv,
            'account.balance': self.handle_balance,
            '/spot/tradeFills': self.handle_my_trade,
            'orderChange': self.handle_order,
        }
        method = self.safe_value(methods, subject)
        if method is None:
            return message
        else:
            return method(client, message)

    def ping(self, client):
        # kucoin does not support built-in ws protocol-level ping-pong
        # instead it requires a custom json-based text ping-pong
        # https://docs.kucoin.com/#ping
        id = str(self.request_id())
        return {
            'id': id,
            'type': 'ping',
        }

    def handle_pong(self, client, message):
        # https://docs.kucoin.com/#ping
        client.lastPong = self.milliseconds()
        return message

    def handle_error_message(self, client, message):
        return message

    def handle_message(self, client, message):
        if self.handle_error_message(client, message):
            type = self.safe_string(message, 'type')
            methods = {
                # 'heartbeat': self.handleHeartbeat,
                'welcome': self.handle_system_status,
                'ack': self.handle_subscription_status,
                'message': self.handle_subject,
                'pong': self.handle_pong,
            }
            method = self.safe_value(methods, type)
            if method is None:
                return message
            else:
                return method(client, message)
