<?php

namespace App\Enums;

enum AddressType: int
{
    case SHIPPING = 0;
    case BILLING = 1;
}
