<head>
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

</head>

<div class="flight-ticket p-6" style="border-radius: 30px; background: #ffffff; box-shadow: 0 5px 20px -5px #0003; max-width: 1500px; margin: 30px auto; font-family:'Helvetica Neue', sans-serif">
    <div style="padding: 2%">
    <div style="text-align: center; margin-bottom: 20px">
        <span style="font-size: 24px; color: #FA5636;"><i class="fas fa-plane mr-1"></i>{{ __('Flight Ticket') }}</span>
    </div>

    <div style="border-bottom: 3px dashed #FA5636; margin-bottom: 20px;"></div>

    <div style="margin-bottom: 20px">
        <div style="font-size: 18px; color: #333;"><strong>{{ $service->title }}</strong></div>
        <div style="color: #888;"><i class="fas fa-ticket-alt mr-1"></i>{{ __('Booking Number') }}: #{{ $booking->id }}</div>
    </div>

    <div style="margin-bottom: 20px">
        <div style="display: flex; justify-content: space-between; align-items: center">
            <div style="flex: 1">
                <div style="color: #888;"><i class="fas fa-plane-departure mr-1"></i>{{ __('From') }}</div>
                <div style="font-size: 20px;"><strong>{{ $service->airportFrom->name }}</strong></div>
                <div style="color: #888;"><small>{{ $service->departure_time->format(' H:i') }}</small></div>
            </div>

            <div style="flex: 0; color: #FA5636; font-size: 24px">
                <i class="fas fa-arrow-right"></i>
            </div>

            <div style="flex: 1; text-align: right">
                <div style="color: #888;"><i class="fas fa-plane-arrival mr-1"></i>{{ __('To') }}</div>
                <div style="font-size: 20px;"><strong>{{ $service->airportTo->name }}</strong></div>
                <div style="color: #888;"><small>{{ $service->arrival_time->format(' H:i') }}</small></div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 20px">
        <div style="color: #888;"><i class="fas fa-fingerprint mr-1"></i>{{ __('Flight Code') }}</div>
        <div style="font-size: 18px;"><strong>{{ $service->code }}</strong></div>
    </div>

    <div style="margin-bottom: 20px">
        <div style="color: #888;"><i class="fas fa-passport mr-1"></i>{{ __('PNR') }}</div>
        <div style="font-size: 18px;"><strong>{{ $service->pnr }}</strong></div>
    </div>

    @if ($booking->getMeta('adults') or $booking->getMeta('children'))
        <div style="margin-bottom: 20px">
            <div style="color: #888;"><i class="fas fa-user-friends mr-1"></i>{{ __('Passengers') }}</div>
            <div>{{ __('Adults') }}: {{ $booking->getMeta('adults') ?: 0 }}, {{ __('Children') }}: {{ $booking->getMeta('children') ?: 0 }}</div>
        </div>
    @endif

    <div style="margin-bottom: 20px">
        <div style="color: #888;"><i class="fas fa-cash-register mr-1"></i>{{ __('Total') }}</div>
        <div style="font-size: 18px;"><strong>{{ format_money($booking->total) }}</strong></div>
    </div>

    <div style="border-bottom: 3px dashed #FA5636; margin-bottom: 20px;"></div>

    <div style="text-align: center">
        <a 
            href="{{ route('user.booking_history') }}"
            style="padding: 10px 20px; background: #FA5636; color: #ffffff; border: none; border-radius: 10px; text-decoration: none">
            {{ __('Manage Bookings') }}
        </a>
    </div>
</div>
</div>