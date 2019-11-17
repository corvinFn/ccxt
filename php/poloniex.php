<?php

namespace ccxtpro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\WebSocketTrait; // websocket functionality

class poloniex extends \ccxt\poloniex {

    use WebSocketTrait;

    public function describe () {
        return array_replace_recursive (parent::describe (), array (
            'has' => array (
                'ws' => true,
                'fetchWsTicker' => true,
                'fetchWsOrderBook' => true,
            ),
            'urls' => array (
                'api' => array (
                    'ws' => 'wss://api2.poloniex.com/',
                ),
            ),
        ));
    }

    public function get_ws_message_hash ($client, $response) {
    //     $channelId = (string) $response[0];
    //     $length = is_array ($response) ? count ($response) : 0;
    //     if ($length <= 2) {
    //         return;
    //     }
    //     if ($channelId === '1002') {
    //         return $channelId . (string) $response[2][0];
    //     } else {
    //         return $channelId;
    //     }
    }

    public function handle_ws_ticker ($client, $response) {
        $data = $response[2];
        $market = $this->safe_value($this->options['marketsByNumericId'], (string) $data[0]);
        $symbol = $this->safe_string($market, 'symbol');
        return array (
            'info' => $response,
            'symbol' => $symbol,
            'last' => floatval ($data[1]),
            'ask' => floatval ($data[2]),
            'bid' => floatval ($data[3]),
            'change' => floatval ($data[4]),
            'baseVolume' => floatval ($data[5]),
            'quoteVolume' => floatval ($data[6]),
            'active' => $data[7] ? false : true,
            'high' => floatval ($data[8]),
            'low' => floatval ($data[9]),
        );
    }

    public function fetch_ws_tickers ($symbol) {
        $this->load_markets();
        $market = $this->market ($symbol);
        $numericId = (string) $market['info']['id'];
        $url = $this->urls['api']['websocket']['public'];
        return $this->WsTickerMessage ($url, '1002' . $numericId, array (
            'command' => 'subscribe',
            'channel' => 1002,
        ));
    }

    public function load_markets ($reload = false, $params = array ()) {
        $markets = parent::load_markets($reload, $params);
        $marketsByNumericId = $this->safe_value($this->options, 'marketsByNumericId');
        if (($marketsByNumericId === null) || $reload) {
            $marketsByNumericId = array();
            for ($i = 0; $i < count ($this->symbols); $i++) {
                $symbol = $this->symbols[$i];
                $market = $this->markets[$symbol];
                $numericId = $this->safe_string($market, 'numericId');
                $marketsByNumericId[$numericId] = $market;
            }
            $this->options['marketsByNumericId'] = $marketsByNumericId;
        }
        return $markets;
    }

    public function fetch_ws_trades ($symbol, $params = array ()) {
        $this->load_markets();
        $market = $this->market ($symbol);
        $numericId = $this->safe_string($market, 'numericId');
        $messageHash = $numericId . ':trades';
        $url = $this->urls['api']['ws'];
        $subscribe = array (
            'command' => 'subscribe',
            'channel' => $numericId,
        );
        return $this->sendWsMessage ($url, $messageHash, $subscribe, $numericId);
    }

    public function fetch_ws_order_book ($symbol, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = $this->market ($symbol);
        $numericId = $this->safe_string($market, 'numericId');
        $messageHash = $numericId . ':orderbook';
        $url = $this->urls['api']['ws'];
        $subscribe = array (
            'command' => 'subscribe',
            'channel' => $numericId,
        );
        // $orderbook = $this->sendWsMessage ($url, $messageHash, array (
        //     'command' => 'subscribe',
        //     'channel' => $numericId,
        // ));
        // return $orderbook->limit ($limit);
        return $this->sendWsMessage ($url, $messageHash, $subscribe, $numericId);
    }

    public function fetch_ws_heartbeat ($params = array ()) {
        $this->load_markets();
        $channelId = '1010';
        $url = $this->urls['api']['ws'];
        return $this->sendWsMessage ($url, $channelId);
    }

    public function sign_ws_message ($message, $params = array ()) {
        $nonce = $this->nonce ();
        $payload = $this->urlencode (array( 'nonce' => $nonce ))
        $signature = $this->hmac ($this->encode ($payload), $this->encode ($this->secret), 'sha512');
        $message = array_merge ($message, array (
            'key' => $this->apiKey,
            'payload' => $payload,
            'sign' => $signature,
        ));
        return $message;
    }

    public function handle_ws_heartbeat ($client, $message) {
        //
        // every second
        //
        //     array ( 1010 )
        //
        $channelId = '1010';
        $this->resolveWsFuture ($client, $channelId, $message);
    }

    public function handle_ws_order_book_and_trades ($client, $message) {
        //
        // first response
        //
        //     [
        //         14, // channelId === $market['numericId']
        //         8767, // $nonce
        //         array (
        //             array (
        //                 "$i", // initial $snapshot
        //                 {
        //                     "currencyPair" => "BTC_BTS",
        //                     "orderBook" => array (
        //                         array( "0.00001853" => "2537.5637", "0.00001854" => "1567238.172367" ), // asks, $price, size
        //                         array( "0.00001841" => "3645.3647", "0.00001840" => "1637.3647" ) // bids
        //                     )
        //                 }
        //             )
        //         )
        //     ]
        //
        // subsequent updates
        //
        //     array (
        //         14,
        //         8768,
        //         array (
        //             array ( "o", 1, "0.00001823", "5534.6474" ), // $orderbook $delta, bids, $price, size
        //             array ( "o", 0, "0.00001824", "6575.464" ), // $orderbook $delta, asks, $price, size
        //             array ( "t", "42706057", 1, "0.05567134", "0.00181421", 1522877119 ) // $trade, id, sell, $price, size, timestamp
        //         )
        //     )
        //
        $marketId = (string) $message[0];
        $nonce = $message[1];
        $data = $message[2];
        $market = $this->safe_value($this->options['marketsByNumericId'], $marketId);
        $symbol = $this->safe_string($market, 'symbol');
        $orderbookUpdatesCount = 0;
        $tradesCount = 0;
        for ($i = 0; $i < count ($data); $i++) {
            $delta = $data[$i];
            if ($delta[0] === 'i') {
                $snapshot = $this->safe_value($delta[1], 'orderBook', array());
                $sides = array ( 'asks', 'bids' );
                $this->orderbooks[$symbol] = $this->orderbook ();
                $orderbook = $this->orderbooks[$symbol];
                for ($j = 0; $j < count ($snapshot); $j++) {
                    $side = $sides[$j];
                    $bookside = $orderbook[$side];
                    $orders = $snapshot[$j];
                    $prices = is_array($orders) ? array_keys($orders) : array();
                    for ($k = 0; $k < count ($prices); $k++) {
                        $price = $prices[$k];
                        $amount = floatval ($orders[$price]);
                        $bookside->store ($price, $amount);
                    }
                }
                $orderbook['nonce'] = $nonce;
                $orderbookUpdatesCount .= 1;
            } else if ($delta[0] === 'o') {
                $orderbook = $this->orderbooks[$symbol];
                $side = $delta[1] ? 'bids' : 'asks';
                $bookside = $orderbook[$side];
                $price = $delta[2];
                $amount = floatval ($delta[3]);
                $bookside->store ($price, $amount);
                $orderbookUpdatesCount .= 1;
            } else if ($delta[0] === 't') {
                $trade = $this->parseWsTrade ($delta);
                $this->trades[] = $trade;
                $tradesCount .= 1;
            }
        }
        if ($orderbookUpdatesCount) {
            // resolve the $orderbook future
            $messageHash = $marketId . ':orderbook';
            $this->resolveWsFuture ($client, $messageHash, $this->orderbooks[$symbol]);
        }
        if ($tradesCount) {
            // resolve the trades future
            $messageHash = $marketId . ':trades';
            $this->resolveWsFuture ($client, $messageHash, $this->trades);
        }
    }

    public function handle_ws_message ($client, $message) {
        $channelId = (string) $message[0];
        $market = $this->safe_value($this->options['marketsByNumericId'], $channelId);
        if ($market === null) {
            $methods = array (
                // '<numericId>' => 'handleWsOrderBookAndTrades', // Price Aggregated Book
                '1000' => 'handleWsPrivateAccountNotifications', // (Beta)
                '1002' => 'handleWsTicker', // Ticker Data
                // '1003' => null, // 24 Hour Exchange Volume
                '1010' => 'handleWsHeartbeat',
            );
            $method = $this->safe_string($methods, $channelId);
            if ($method === null) {
                return $message;
            } else {
                return $this->$method ($client, $message);
            }
        } else {
            return $this->handle_ws_order_book_and_trades ($client, $message);
        }
        // if (is_array($this->options['marketsByNumericId']) && array_key_exists($channelId, $this->options['marketsByNumericId'])) {
        //     return $this->handle_ws_order_book_and_trades ($message);
        // } else {
        //     $methods = array (
        //         // '<numericId>' => 'handleWsOrderBookAndTrades', // Price Aggregated Book
        //         '1000' => 'handleWsPrivateAccountNotifications', // (Beta)
        //         '1002' => 'handleWsTicker', // Ticker Data
        //         // '1003' => null, // 24 Hour Exchange Volume
        //         '1010' => 'handleWsHeartbeat',
        //     );
        //     $method = $this->safe_string($methods, $channelId);
        //     if ($method === null) {
        //         return $message;
        //     } else {
        //         return $this->$method ($message);
        //     }
        // }
    }
}
