<?php

namespace App\View\Helper;

use Cake\View\Helper;

class VoucherHelper extends Helper
{
    public function getVoucher($amount)
    {
        if ($amount > 30000000) {
            return 'Voucher Hotel Santika';
        } else {
            return 'Voucher Belanja Indomaret';
        }
    }
}
