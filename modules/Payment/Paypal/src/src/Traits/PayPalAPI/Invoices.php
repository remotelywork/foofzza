<?php

namespace Srmklive\PayPal\Traits\PayPalAPI;

trait Invoices
{
    /**
     * Generate the next invoice number.
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_generate-next-invoice-number
     */
    public function generateInvoiceNumber()
    {
        $this->apiEndPoint = 'v2/invoicing/generate-next-invoice-number';

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Create a new draft invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_create
     */
    public function createInvoice(array $data)
    {
        $this->apiEndPoint = 'v2/invoicing/invoices';

        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Get list of invoices.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_list
     */
    public function listInvoices(int $page = 1, int $size = 20, bool $totals = true, array $fields = [])
    {
        $totals = ($totals === true) ? 'true' : 'false';

        $fields_list = collect($fields);

        $fields = ($fields_list->count() > 0) ? "&fields={$fields_list->implode(',')}" : '';

        $this->apiEndPoint = "v2/invoicing/invoices?page={$page}&page_size={$size}&total_required={$totals}{$fields}";

        $this->verb = 'get';

        return $this->doPayPalRequest();
    }

    /**
     * Delete an invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_list
     */
    public function deleteInvoice(string $invoice_id)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}";

        $this->verb = 'delete';

        return $this->doPayPalRequest(false);
    }

    /**
     * Update an existing invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_update
     */
    public function updateInvoice(string $invoice_id, array $data)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}";

        $this->options['json'] = $data;

        $this->verb = 'put';

        return $this->doPayPalRequest();
    }

    /**
     * Show details for an existing invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_get
     */
    public function showInvoiceDetails(string $invoice_id)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}";

        $this->verb = 'get';

        return $this->doPayPalRequest();
    }

    /**
     * Cancel an existing invoice which is already sent.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_cancel
     */
    public function cancelInvoice(string $invoice_id, array $notes)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/cancel";

        $this->options['json'] = $notes;

        $this->verb = 'post';

        return $this->doPayPalRequest(false);
    }

    /**
     * Generate QR code against an existing invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_generate-qr-code
     */
    public function generateQRCodeInvoice(string $invoice_id, int $width = 100, int $height = 100)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/generate-qr-code";

        $this->options['json'] = [
            'width' => $width,
            'height' => $height,
        ];
        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Register payment against an existing invoice.
     *
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_payments
     */
    public function registerPaymentInvoice(string $invoice_id, string $payment_date, string $payment_method, float $amount, string $payment_note = '', string $payment_id = '')
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/payments";

        $data = [
            'payment_id' => $payment_id,
            'payment_date' => $payment_date,
            'method' => $payment_method,
            'note' => $payment_note,
            'amount' => [
                'currency_code' => $this->currency,
                'value' => $amount,
            ],
        ];

        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Delete payment against an existing invoice.
     *
     * @param  string  $invoice_id
     * @param  string  $transaction_id
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_payments-delete
     */
    public function deleteExternalPaymentInvoice($invoice_id, $transaction_id)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/payments/{$transaction_id}";

        $this->verb = 'delete';

        return $this->doPayPalRequest(false);
    }

    /**
     * Register payment against an existing invoice.
     *
     * @param  string  $invoice_id
     * @param  string  $payment_date
     * @param  string  $payment_method
     * @param  float  $amount
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_refunds
     */
    public function refundInvoice($invoice_id, $payment_date, $payment_method, $amount)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/refunds";

        $data = [
            'refund_date' => $payment_date,
            'method' => $payment_method,
            'amount' => [
                'currency_code' => $this->currency,
                'value' => $amount,
            ],
        ];

        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Delete refund against an existing invoice.
     *
     * @param  string  $invoice_id
     * @param  string  $transaction_id
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_refunds-delete
     */
    public function deleteRefundInvoice($invoice_id, $transaction_id)
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/refunds/{$transaction_id}";

        $this->verb = 'delete';

        return $this->doPayPalRequest(false);
    }

    /**
     * Send an existing invoice.
     *
     * @param  string  $invoice_id
     * @param  string  $subject
     * @param  string  $note
     * @param  bool  $send_recipient
     * @param  bool  $send_merchant
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_send
     */
    public function sendInvoice($invoice_id, $subject = '', $note = '', $send_recipient = true, $send_merchant = false, array $recipients = [])
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/send";

        $data = [
            'subject' => ! empty($subject) ? $subject : '',
            'note' => ! empty($note) ? $note : '',
            'additional_recipients' => (collect($recipients)->count() > 0) ? $recipients : '',
            'send_to_recipient' => $send_recipient,
            'send_to_invoicer' => $send_merchant,
        ];

        $this->options['json'] = collect($data)->filter()->toArray();

        $this->verb = 'post';

        return $this->doPayPalRequest(false);
    }

    /**
     * Send reminder for an existing invoice.
     *
     * @param  string  $invoice_id
     * @param  string  $subject
     * @param  string  $note
     * @param  bool  $send_recipient
     * @param  bool  $send_merchant
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws \Throwable
     *
     * @see https://developer.paypal.com/docs/api/invoicing/v2/#invoices_remind
     */
    public function sendInvoiceReminder($invoice_id, $subject = '', $note = '', $send_recipient = true, $send_merchant = false, array $recipients = [])
    {
        $this->apiEndPoint = "v2/invoicing/invoices/{$invoice_id}/remind";

        $data = [
            'subject' => ! empty($subject) ? $subject : '',
            'note' => ! empty($note) ? $note : '',
            'additional_recipients' => (collect($recipients)->count() > 0) ? $recipients : '',
            'send_to_recipient' => $send_recipient,
            'send_to_invoicer' => $send_merchant,
        ];

        $this->options['json'] = collect($data)->filter()->toArray();

        $this->verb = 'post';

        return $this->doPayPalRequest(false);
    }
}
