import os
import sys

root = os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__)))))
sys.path.append(root)

# ----------------------------------------------------------------------------

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

# ----------------------------------------------------------------------------
# -*- coding: utf-8 -*-


from ccxt.base.precise import Precise  # noqa E402
from ccxt.test.base import test_shared_methods  # noqa E402


def test_balance(exchange, skipped_properties, method, entry):
    format = {
        'free': {},
        'used': {},
        'total': {},
        'info': {},
    }
    test_shared_methods.assert_structure(exchange, skipped_properties, method, entry, format)
    log_text = test_shared_methods.log_template(exchange, method, entry)
    #
    codes_total = list(entry['total'].keys())
    codes_free = list(entry['free'].keys())
    codes_used = list(entry['used'].keys())
    all_codes = exchange.array_concat(codes_total, codes_free)
    all_codes = exchange.array_concat(all_codes, codes_used)
    codes_length = len(codes_total)
    free_length = len(codes_free)
    used_length = len(codes_used)
    assert (codes_length == free_length) or (codes_length == used_length), 'free and total and used codes have different lengths' + log_text
    for i in range(0, len(all_codes)):
        code = all_codes[i]
        # testSharedMethods.assertCurrencyCode (exchange, skippedProperties, method, entry, code);
        assert code in entry['total'], 'code ' + code + ' not in total' + log_text
        assert code in entry['free'], 'code ' + code + ' not in free' + log_text
        assert code in entry['used'], 'code ' + code + ' not in used' + log_text
        total = exchange.safe_string(entry['total'], code)
        free = exchange.safe_string(entry['free'], code)
        used = exchange.safe_string(entry['used'], code)
        assert total is not None, 'total is undefined' + log_text
        assert free is not None, 'free is undefined' + log_text
        assert used is not None, 'used is undefined' + log_text
        assert Precise.string_ge(total, '0'), 'total is not positive' + log_text
        assert Precise.string_ge(free, '0'), 'free is not positive' + log_text
        assert Precise.string_ge(used, '0'), 'used is not positive' + log_text
        sum_free_used = Precise.string_add(free, used)
        assert Precise.string_eq(total, sum_free_used), 'free and used do not sum to total' + log_text
