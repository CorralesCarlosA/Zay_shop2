<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5>Ventas Mensuales</h5>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                {{ now()->year }}
            </button>
            <ul class="dropdown-menu">
                @foreach(range(now()->year, now()->year-3) as $year)
                <li><a class="dropdown-item" href="#">{{ $year }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card-body p-0">
        <canvas id="ventasChart" height="100"></canvas>
    </div>
</div>

@push('scripts')
<script>
    // El script de la gráfica que proporcionamos arriba
</script>
@endpush