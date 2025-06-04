@extends('layouts.app')

@section('title', 'ZAYSHOP - Contacto')

@section('content')
<div class="container py-5" style="background-color: #ffffff;">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #000000;">Contáctanos</h1>
        <p class="lead" style="color: #000000;">Estamos aquí para ayudarte con tus compras y dudas</p>
    </div>

    <!-- Contact Info -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #d4af37;">Información de Contacto</h2>
                    <p><strong>Email:</strong> contacto@zayshop.com</p>
                    <p><strong>Teléfono:</strong> +54 123 456 7890</p>
                    <p><strong>Dirección:</strong> Calle 123, Ciudad, quibdo</p>
                    <p><strong>Redes Sociales:</strong> Facebook | Instagram | Twitter</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #d4af37;">Horario de Atención</h2>
                    <p><strong>Lunes a Viernes:</strong> 9:00 AM - 6:00 PM</p>
                    <p><strong>Sábado:</strong> 10:00 AM - 4:00 PM</p>
                    <p><strong>Domingo:</strong> Cerrado</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #28a745;">Envíanos un Mensaje</h2>
                    <form action="" >
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection