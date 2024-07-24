@if ($personas->isEmpty())
    <p>No se encontraron personas.</p>
@else
    @foreach ($personas as $persona)
        <div class="persona-result-box" data-id="{{ $persona->id }}">
            <div class="persona-result-image">
                @if ($persona->image)
                    <img class="img-tabla-personas" src="{{ Storage::url($persona->image) }}"
                        alt="Imagen de {{ $persona->name }}" width="50">
                @else
                    No Image
                @endif
            </div>
            <div class="persona-result-info">

                <p><strong>Nombre:</strong> {{ $persona->name }}</p>
                <p><strong>Sexo:</strong> {{ $persona->sexo }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $persona->fecha_nacimiento }}</p>
                <p><strong>Estado Civil:</strong> {{ $persona->estado_civil }}</p>
            </div>
        </div>
    @endforeach
@endif
