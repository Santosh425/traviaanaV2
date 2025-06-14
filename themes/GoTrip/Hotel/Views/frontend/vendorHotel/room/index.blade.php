@extends('layouts.user')
@section('content')
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600">{{__("Manage Rooms")}}</h1>
        </div>
        <div class="col-auto">
            <div class="d-flex">
                <a href="{{route('hotel.vendor.edit',['id'=>$hotel->id])}}" class="btn btn-info mr-2"><i class="fa fa-hand-o-right"></i> {{__("Back to hotel")}}</a>
                <a href="{{route('hotel.vendor.room.availability.index',['hotel_id'=>$hotel->id])}}" class="btn btn-warning mr-2"><i class="fa fa-calendar"></i> {{__("Availability Rooms")}}</a>
                <a href="{{ route("hotel.vendor.room.create",['hotel_id'=>$hotel->id]) }}" class="btn btn-success mr-2"><i class="fa fa-plus" aria-hidden="true"></i> {{__("Add Room")}}</a>
            </div>
        </div>
    </div>
    @include('admin.message')
    @if($rows->total() > 0)
        <div class="bravo-list-item py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="list-item mt-0">
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-md-12">
                            @include('Hotel::frontend.vendorHotel.room.loop-list')
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bravo-pagination mt-0 mb-0">
                <span class="count-string">{{ __("Showing :from - :to of :total Rooms",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    @else
        {{__("No Room")}}
    @endif
@endsection
