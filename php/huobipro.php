<?php

namespace ccxtpro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import

class huobipro extends huobi {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'alias' => true,
            'id' => 'huobipro',
        ));
    }
}
