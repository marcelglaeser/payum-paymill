<?php

/**
 * @copyright wiseape GmbH
 * @author Ruben Rögels
 * @license LGPL-3.0+
 */

namespace Wiseape\Payum\Paymill\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\FillOrderDetails;

class FillOrderDetailsAction implements ActionInterface {

    /**
     * {@inheritDoc}
     *
     * @param FillOrderDetails $request
     */
    public function execute($request) {
        RequestNotSupportedException::assertSupports($this, $request);

        $order = $request->getOrder();

        $details = $order->getDetails();
        $details['amount'] = $order->getTotalAmount();
        $details['currency'] = $order->getCurrencyCode();
        $details['description'] = $order->getNumber();

        $order->setDetails($details);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($request) {
        return $request instanceof FillOrderDetails;
    }

}
