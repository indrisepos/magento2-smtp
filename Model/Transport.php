<?php

namespace Abzertech\Smtp\Model;

use Exception;
use InvalidArgumentException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\Phrase;
use Zend_Mail;
use Zend_Mail_Transport_Sendmail;

/**
 * Class Transport
 */
class Transport extends Zend_Mail_Transport_Sendmail implements TransportInterface
{

    /**
     * @var Message
     */
    protected $message;

    /**
     * Transport constructor.
     *
     * @param MessageInterface $message
     * @param null $parameters
     */
    public function __construct(MessageInterface $message, $parameters = null)
    {
        if (!$message instanceof Zend_Mail) {
            throw new InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }

        parent::__construct($parameters);
        $this->message = $message;
    }

    /**
     * Send a mail using this transport
     *
     * @return void
     * @throws MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->message);
        } catch (Exception $e) {
            throw new MailException(new Phrase($e->getMessage()), $e);
        }
    }

    /**
     * return message
     *
     * @return MessageInterface|Zend_Mail
     */
    public function getMessage()
    {
        return $this->message;
    }
}
