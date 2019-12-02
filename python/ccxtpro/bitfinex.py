# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

import ccxtpro
import ccxt.async_support as ccxt
from ccxt.base.errors import ExchangeError


class bitfinex(ccxtpro.Exchange, ccxt.bitfinex):

    def describe(self):
        return self.deep_extend(super(bitfinex, self).describe(), {
            'has': {
                'fetchWsTicker': True,
                'fetchWsOrderBook': True,
            },
            'urls': {
                'api': {
                    'ws': {
                        'public': 'wss://api-pub.bitfinex.com/ws/2',
                        'private': 'wss://api.bitfinex.com',
                    },
                },
            },
            'options': {
                'subscriptionsByChannelId': {},
            },
        })

    async def fetch_ws_order_book(self, symbol, limit=None, params={}):
        if limit is not None:
            if (limit != 25) and (limit != 100):
                raise ExchangeError(self.id + ' fetchWsOrderBook limit argument must be None, 25 or 100')
        await self.load_markets()
        market = self.market(symbol)
        marketId = market['id']
        url = self.urls['api']['ws']['public']
        channel = 'book'
        request = {
            'event': 'subscribe',
            'channel': channel,
            'symbol': marketId,
            # 'prec': 'P0',  # string, level of price aggregation, 'P0', 'P1', 'P2', 'P3', 'P4', default P0
            # 'freq': 'F0',  # string, frequency of updates 'F0' = realtime, 'F1' = 2 seconds, default is 'F0'
            # 'len': '25',  # string, number of price points, '25', '100', default = '25'
        }
        if limit is not None:
            request['limit'] = str(limit)
        messageHash = channel + ':' + marketId
        return self.sendWsMessage(url, messageHash, self.deep_extend(request, params), messageHash)

    def handle_ws_order_book(self, client, message):
        #
        # first message(snapshot)
        #
        #     [
        #         18691,  # channel id
        #         [
        #             [7364.8, 10, 4.354802],  # price, count, size > 0 = bid
        #             [7364.7, 1, 0.00288831],
        #             [7364.3, 12, 0.048],
        #             [7364.9, 3, -0.42028976],  # price, count, size < 0 = ask
        #             [7365, 1, -0.25],
        #             [7365.5, 1, -0.00371937],
        #         ]
        #     ]
        #
        # subsequent updates
        #
        #     [
        #         39393,  # channel id
        #         [7138.9, 0, -1],  # price, count, size, size > 0 = bid, size < 0 = ask
        #     ]
        #
        channelId = str(message[0])
        subscription = self.safe_value(self.options['subscriptionsByChannelId'], channelId, {})
        #
        #     {
        #         event: 'subscribed',
        #         channel: 'book',
        #         chanId: 67473,
        #         symbol: 'tBTCUSD',  # v2 id
        #         prec: 'P0',
        #         freq: 'F0',
        #         len: '25',
        #         pair: 'BTCUSD',  # v1 id
        #     }
        #
        marketId = self.safe_string(subscription, 'pair')
        market = self.markets_by_id[marketId]
        symbol = market['symbol']
        messageHash = 'book:' + marketId
        # if it is an initial snapshot
        if isinstance(message[1][0], list):
            limit = self.safe_integer(subscription, 'len')
            self.orderbooks[symbol] = self.limitedCountedOrderBook({}, limit)
            orderbook = self.orderbooks[symbol]
            deltas = message[1]
            for i in range(0, len(deltas)):
                delta = deltas[i]
                side = 'asks' if (delta[2] < 0) else 'bids'
                bookside = orderbook[side]
                self.handle_ws_delta(bookside, delta)
            # the .limit() operation will be moved to the fetchWSOrderBook
            client.resolve(orderbook.limit(), messageHash)
        else:
            orderbook = self.orderbooks[symbol]
            side = 'asks' if (message[1][2] < 0) else 'bids'
            bookside = orderbook[side]
            self.handle_ws_delta(bookside, message[1])
            # the .limit() operation will be moved to the fetchWSOrderBook
            client.resolve(orderbook.limit(), messageHash)

    def handle_ws_delta(self, bookside, delta):
        price = delta[0]
        count = delta[1]
        amount = -delta[2] if (delta[2] < 0) else delta[2]
        bookside.store(price, amount, count)

    def handle_ws_heartbeat(self, client, message):
        #
        # every second(approx) if no other updates are sent
        #
        #     {"event": "heartbeat"}
        #
        event = self.safe_string(message, 'event')
        client.resolve(message, event)

    def handle_ws_system_status(self, client, message):
        #
        # todo: answer the question whether handleWsSystemStatus should be renamed
        # and unified as handleWsStatus for any usage pattern that
        # involves system status and maintenance updates
        #
        #     {
        #         event: 'info',
        #         version: 2,
        #         serverId: 'e293377e-7bb7-427e-b28c-5db045b2c1d1',
        #         platform: {status: 1},  # 1 for operative, 0 for maintenance
        #     }
        #
        return message

    def handle_ws_subscription_status(self, client, message):
        #
        # todo: answer the question whether handleWsSubscriptionStatus should be renamed
        # and unified as handleWsResponse for any usage pattern that
        # involves an identified request/response sequence
        #
        #     {
        #         event: 'subscribed',
        #         channel: 'book',
        #         chanId: 67473,
        #         symbol: 'tBTCUSD',
        #         prec: 'P0',
        #         freq: 'F0',
        #         len: '25',
        #         pair: 'BTCUSD'
        #     }
        #
        # --------------------------------------------------------------------
        #
        channelId = self.safe_string(message, 'chanId')
        self.options['subscriptionsByChannelId'][channelId] = message
        return message

    def sign_ws_message(self, client, messageHash, message, params={}):
        # todo: bitfinex signWsMessage not implemented yet
        return message

    def handle_ws_message(self, client, message):
        # print(new Date(), message)
        if isinstance(message, list):
            channelId = str(message[0])
            subscription = self.safe_value(self.options['subscriptionsByChannelId'], channelId, {})
            channel = self.safe_string(subscription, 'channel')
            methods = {
                'book': 'handleWsOrderBook',
                # 'ohlc': 'handleWsOHLCV',
                # 'ticker': 'handleWsTicker',
                # 'trade': 'handleWsTrades',
            }
            method = self.safe_string(methods, channel)
            if method is None:
                return message
            else:
                return getattr(self, method)(client, message)
        else:
            # todo: add bitfinex handleWsErrors
            #
            #     {
            #         event: 'info',
            #         version: 2,
            #         serverId: 'e293377e-7bb7-427e-b28c-5db045b2c1d1',
            #         platform: {status: 1},  # 1 for operative, 0 for maintenance
            #     }
            #
            event = self.safe_string(message, 'event')
            if event is not None:
                methods = {
                    'info': 'handleWsSystemStatus',
                    # 'book': 'handleWsOrderBook',
                    'subscribed': 'handleWsSubscriptionStatus',
                }
                method = self.safe_string(methods, event)
                if method is None:
                    return message
                else:
                    return getattr(self, method)(client, message)
