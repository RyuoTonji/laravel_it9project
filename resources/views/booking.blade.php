@extends('layouts.app')

@section('title', 'Booking')

@section('content')
    <div class="booking-container">
        <div class="booking-content">
            <h2>Book Your Stay</h2>
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="checkIn">Check-In Date</label>
                    <input type="date" class="form-control" id="checkIn" name="checkIn" required>
                    @error('checkIn')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="checkOut">Check-Out Date</label>
                    <input type="date" class="form-control" id="checkOut" name="checkOut" required>
                    @error('checkOut')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="guests">Number of Guests</label>
                    <input type="number" class="form-control" id="guests" name="guests" min="1" required>
                    @error('guests')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="roomType">Room Type</label>
                    <select class="form-control" id="roomType" name="roomType" required>
                        <option value="" disabled selected>Select Room Type</option>
                        @foreach ($rooms->keys() as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    @error('roomType')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-confirm">Confirm Booking</button>
                    <button type="button" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection