@extends('layouts.app')

@section('title', 'ZAY - Sobre Nosotros')

@section('content')
<div class="container py-5" style="background-color: #ffffff;">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <img src="/img/zay-logo.png" alt="ZAY Logo" style="max-height: 120px; margin-bottom: 2rem;">
        <h1 class="display-4 fw-bold" style="color: #000000;">VELOCIDAD · DINAMISMO · EXCELENCIA</h1>
        <p class="lead" style="color: #000000;">Inspirados en Hermes, el dios mensajero y protector de los atletas</p>
    </div>

    <!-- About Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #d4af37; border-bottom: 2px solid #d4af37; padding-bottom: 10px;">Nuestra Esencia</h2>
                    <p class="mt-3" style="color: #000000; font-size: 1.1rem;">
                        ZAY encarna la velocidad, el dinamismo y la excelencia en el mundo del deporte. 
                        Nuestro nombre simboliza lo ágil, lo que lucha con determinación, inspirando a 
                        atletas a superar todos los límites.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #d4af37; border-bottom: 2px solid #d4af37; padding-bottom: 10px;">Inspiración</h2>
                    <p class="mt-3" style="color: #000000; font-size: 1.1rem;">
                        Como Hermes, el dios griego mensajero y protector de los atletas, nuestro símbolo 
                        representa las sandalias aladas que encapsulan velocidad y rendimiento, reforzando 
                        nuestro compromiso con el desarrollo deportivo.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 10px;">
                        <i class="bi bi-bullseye"></i> Misión
                    </h2>
                    <p class="mt-3" style="color: #000000; font-size: 1.1rem;">
                        Motivar y empoderar a atletas a través de productos y servicios de alta calidad 
                        diseñados para mejorar el rendimiento y promover el desarrollo personal. Nos 
                        dedicamos a la innovación y excelencia en cada solución que ofrecemos.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h2 style="color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 10px;">
                        <i class="bi bi-eye"></i> Visión
                    </h2>
                    <p class="mt-3" style="color: #000000; font-size: 1.1rem;">
                        Ser líderes en la industria del deporte, reconocidos por nuestra influencia en la 
                        vida de los atletas y dedicación a la excelencia. Aspiramos a ser modelo de 
                        innovación, promoviendo valores de dedicación, disciplina y determinación.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #000000;">Nuestros Valores Fundamentales</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body text-center p-4">
                    <div style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h4 style="color: #000000;">Velocidad</h4>
                    <p style="color: #000000;">Respuesta ágil y soluciones inmediatas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body text-center p-4">
                    <div style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h4 style="color: #000000;">Excelencia</h4>
                    <p style="color: #000000;">Calidad superior en cada producto</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body text-center p-4">
                    <div style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h4 style="color: #000000;">Pasión</h4>
                    <p style="color: #000000;">Amor por el deporte y el rendimiento</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection