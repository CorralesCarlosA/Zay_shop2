<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if(isset($method))
                @method($method)
            @endif

            <div class="form-group">
                <label for="nombreClase">Nombre de la Clase *</label>
                <input type="text" class="form-control @error('nombreClase') is-invalid @enderror" 
                       id="nombreClase" name="nombreClase" 
                       value="{{ old('nombreClase', $clase->clase ?? '') }}" required>
                @error('nombreClase')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <small class="form-text text-muted">Ejemplo: Ropa, Calzado, Accesorios</small>
            </div>

            <div class="form-group text-right mt-4">
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($clase->idClaseProducto) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>