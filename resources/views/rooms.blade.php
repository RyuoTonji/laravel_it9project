@extends('layouts.app')

@section('title', 'Roomss')

@section('content')

<main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
        <h1 class="display-4 fw-bold mb-3">Rooms and Suites</h1>
        <div class="bg-secondary p-5 text-center text-white" style="height: 300px;">
            <p>Background Image</p>
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="mb-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="bg-light p-5 text-center" style="height: 200px;">
                        <p class="text-muted">Image here...</p>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fs-5">Deluxe King Room</h3>
                        <p class="card-text">Some text here...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">₱30,000/night</span>
                            <a href="booking.php" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="bg-light p-5 text-center" style="height: 200px;">
                        <p class="text-muted">Image here...</p>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fs-5">Executive Suite</h3>
                        <p class="card-text">Some text here...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">₱20,000/night</span>
                            <a href="booking.php" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="bg-light p-5 text-center" style="height: 200px;">
                        <p class="text-muted">Image here...</p>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fs-5">Family Suite</h3>
                        <p class="card-text">Some text here...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">₱10,000ght</span>
                            <a href="booking.php" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection