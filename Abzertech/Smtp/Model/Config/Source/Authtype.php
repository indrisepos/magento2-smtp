<?php

namespace Abzertech\Smtp\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Authtype
 */
class Authtype implements ArrayInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
                ['value' => 'none', 'label' => __('None')],
                ['value' => 'ssl', 'label' => 'SSL'],
                ['value' => 'tls', 'label' => 'TLS']
        ];
    }
}
