@extends('layouts.app')

@section('title', 'Explore')

@section('content')

<main class="container my-5">
    <!-- Hero Section -->
    <section class="bg-light py-5 mb-5 text-center">
        <h1 class="display-4 fw-bold mb-3">Take a Tour</h1>
        <p class="lead">Discover our world-class accommodations and amenities for an unforgettable stay.</p>
    </section>

    <!-- Tour Section -->
    <section class="mb-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="bg-light p-5 text-center" style="height: 300px;">
                        <p class="text-muted">Image here</p>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="card-title fs-5 text-warning">Gym center</h3>
                        <p class="card-text">Some information here...</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="bg-light p-5 text-center" style="height: 300px;">
                        <p class="text-muted">Image here</p>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="card-title fs-5 text-warning">Gym center</h3>
                        <p class="card-text">Some information here...</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="bg-light p-5 text-center" style="height: 300px;">
                        <p class="text-muted">Image here</p>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="card-title fs-5 text-warning">THE FACILITY</h3>
                        <p class="card-text">Some information here...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection