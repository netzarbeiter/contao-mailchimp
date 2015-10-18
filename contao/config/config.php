<?php

$GLOBALS['BE_MOD']['content']['mailchimp'] = [
    'tables' => ['tl_mailchimp'],
    'icon' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAmJJREFUeNpi/P//PwMDAxMQ/7y9FSCAGCE8Zk/57x8/fwYIIAYgz3XyhWgXm0f37oCknj24y/vvyY3z5wACCKoOCv7/+WnhmVAU5AgSPXtwd1uc4/sbe4AcJiM7l9cffzPzCANVAQQQyDQg+Pv9c/SEvevnhjq7BDZWVAJFWICSaW1Ltq3fkKL2wSInzqT291deLaijujM96+2Zvv/8JaZlxiqqwsnO9vvXL6hRQPDhzev+yoLFEzshXIAAQnUXEmCBUKvXblx2n8Hhx66+OYcfPrgEleiZtnj3V3nmzXWPxVnM1cRgOn7/mP5cRXt/YaybmpWDLQsbG0SCiYGVI/9FrZ6iiJCQwIdvDOxCMs/u34E6l09G/feff3zCYsLy6l9/MNy/dQ0qkVA/9efvPxdPnRISFxUQ4hUSEUEECRBsW76woyDtzrUrEC5AgGHxx8NbN85cucbF/M7B1vnTV6Y3r18pa2hxcHFDZBEa/nz7OG35jv1/1H8xsP69uu/PrcOPHz76+fvX24/fChL8mru7UALkwL79uds/MbLwMR6q1+B4ryLCIq7AzqYswMzwl1/G0iurCiUE///+vvH8S/5396Vvr5GWFJLgYfYK9NIx0nv+9LWQiPCNazcf3riobW4PCyegs1g5I/W5k/mPzprZzMHF9fYb45lDh56/+ChpaMkuqazv6CEn9OvAmrkIDUBg5uIb07l+ycoDr1++4mX7r6CuySMmd+/ak9fvmN5+4f7FKcfOwfb961cUT0PA1TMnFk3o+PzmqYqStJGtHQsn17NHzySVDQ1tnXj4+LFoIAgAGdwwCAijW7AAAAAASUVORK5CYII=',
];

$GLOBALS['FE_MOD']['mailchimp'] = [
    'mailchimp_subscribe' => 'Oneup\Contao\MailChimp\Module\ModuleSubscribe',
];
