<?php

namespace Omnipay\Gvp\Message;

/**
 * Gvp Gateway
 * (c) Aykut OKYAY
 * 2022, aykutokyay.com.tr
 * http://www.github.com/okyayaykut/omnipay-gvp
 */
class CaptureRequest extends PurchaseRequest
{
    protected $actionType = 'postauth';
}
