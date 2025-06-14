@extends('Layout::empty')

@push('css')
    {{-- <style type="text/css">
        html, body {
            background: #f0f0f0;
        }
        .bravo_topbar, .bravo_header, .bravo_footer {
            display: none;
        }
        .invoice-amount {
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 20px;
            display: inline-block;
            text-align: center;
        }
        .email_new_booking .b-table {
            width: 100%;
        }
        .email_new_booking .val {
            text-align: right;
        }
        .email_new_booking td,
        .email_new_booking th {
            padding: 5px;
        }
        .email_new_booking .val table {
            text-align: left;
        }
        .email_new_booking .b-panel-title,
        .email_new_booking .booking-number,
        .email_new_booking .booking-status,
        .email_new_booking .manage-booking-btn {
            display: none;
        }
        .email_new_booking .fsz21 {
            font-size: 21px;
        }
        .table-service-head {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .table-service-head th {
            padding: 5px 15px;
        }
        #invoice-print-zone {
            background: rgb(88, 219, 255);
            padding: 15px;
            margin: 90px auto 40px auto;
            max-width: 1025px;
        }
        .invoice-company-info{
            margin-top: 15px;
        }
        .invoice-company-info p{
            margin-bottom: 2px;
            font-weight: normal;
        }
    </style> --}}

    <style type="text/css">
        :root {
            --primary: #fafafa;
            --primary-light: #ffedd5;
            --dark: #334155;
            --light: #edf2f7;
            --border: #e2e8f0;
        }

        html,
        body {
            background: var(--light);
            color: var(--dark);
            font-family: 'Helvetica Neue', sans-serif;
        }

        .bravo_topbar,
        .bravo_header,
        .bravo_footer {
            display: none;
        }

        .invoice-amount {
            margin-top: 20px;
            border: none;
            border-radius: 12px;
            padding: 20px 30px;
            display: inline-block;
            text-align: center;
            background: var(--primary-light);
            color: var(--dark);
            box-shadow: 0 5px 20px -10px #0003;
        }

        .email_new_booking .b-table {
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px -10px #0003;
            margin-bottom: 20px;
        }

        .email_new_booking .val {
            text-align: right;
        }

        .email_new_booking td,
        .email_new_booking th {
            padding: 10px 15px;
            color: var(--dark);
            border-bottom: 1px solid var(--border);
        }

        .email_new_booking .val table {
            text-align: left;
        }

        .email_new_booking .b-panel-title,
        .email_new_booking .booking-number,
        .email_new_booking .booking-status,
        .email_new_booking .manage-booking-btn {
            display: none;
        }

        .email_new_booking .fsz21 {
            font-size: 21px;
            color: var(--dark);
            font-weight: bold;
        }

        .table-service-head {
            background: var(--primary-light);
            color: var(--dark);
            border-bottom: 1px solid var(--border);
        }

        .table-service-head th {
            padding: 10px 15px;
            font-weight: 600;
        }

        #invoice-print-zone {
            background: #ff9962;
            padding: 40px 30px;
            margin: 60px auto 40px;
            max-width: 1025px;
            border-radius: 20px;
            box-shadow: 0 10px 30px -15px #0003;
        }

        .invoice-company-info {
            margin-top: 20px;
        }

        .invoice-company-info p {
            margin-bottom: 5px;
            font-weight: normal;
            color: var(--dark);
        }

        .customer-info {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 10px;
            padding: 10px;
            background: var(--primary-light);
            border-radius: 12px;
            box-shadow: 0 5px 20px -10px #0003;
        }

     

        @media (max-width: 767px) {
            #invoice-print-zone {
                padding: 20px;
                margin: 20px;
            }

            .email_new_booking .b-table,
            .invoice-amount {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>

    <link href="{{ asset('module/user/css/user.css') }}" rel="stylesheet">
    <script>
        window.print();
    </script>
    <div id="invoice-print-zone">
        <table width="100%" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="50%">
                        @if (!empty(($logo = setting_item('logo_invoice_id') ?? setting_item('logo_id'))))
                            <img style="max-width: 200px;" src="{{ get_file_url($logo, 'full') }}"
                                alt="{{ setting_item('site_title') }}">
                        @endif
                        <div class="invoice-company-info">
                            {!! setting_item_with_lang('invoice_company_info') !!}
                        </div>
                    </th>
                    <th width="50%" align="right" class="text-right">
                        <h2 class="invoice-text-title">{{ __('INVOICE') }}</h2>
                        {{ __('Invoice #: :number', ['number' => $booking->id]) }}
                        <br>
                        {{ __('Created: :date', ['date' => display_date($booking->created_at)]) }}
                    </th>
                </tr>
                <tr>
                    <th width="50%">
                        {!! nl2br(setting_item('invoice_company')) !!}
                    </th>
                    <th width="50%" align="right" class="text-right">
                        <div class="invoice-amount">
                            <div class="label">{{ __('Amount due:') }}</div>
                            <div class="amount" style="font-size: 24px;">
                                <strong>{{ format_money($booking->total - $booking->paid) }}</strong>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
        <hr>
        <div class="customer-info">
            <h5><strong>{{ __('Billing to:') }}</strong></h5>
            <span>{{ $booking->first_name . ' ' . $booking->last_name }}</span>
            <span>{{ $booking->email }}</span><br>
            <span>{{ $booking->phone }}</span><br>
            <span>{{ $booking->address }}</span><br>
            <span>{{ implode(', ', [$booking->city, $booking->state, $booking->zip_code, get_country_name($booking->country)]) }}</span><br>
        </div>
        <hr>
        @if (!empty($service->email_new_booking_file))
            <div class="email_new_booking">
                @include($service->email_new_booking_file ?? '')
            </div>
        @endif
    </div>
@endpush



@push('js')
    <script type="text/javascript" src="{{ asset('module/user/js/user.js') }}"></script>
@endpush
