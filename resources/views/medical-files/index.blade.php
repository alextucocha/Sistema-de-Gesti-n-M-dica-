<!DOCTYPE html>
<html>
<head>
    <title>Archivos Médicos</title>
    <style>
        body { font-family: Arial; max-width: 1000px; margin: 20px auto; padding: 20px; }
        .header { display: flex; justify-content: between; align-items: center; margin-bottom: 30px; }
        .archivo { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .archivo:hover { background: #f9f9f9; }
        .acciones { margin-top: 10px; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-right: 5px; }
        .btn-descargar { background: #28a745; color: white; }
        .btn-ver { background: #007bff; color: white; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📁 Archivos Médicos</h1>
        <a href="{{ route('medical-files.create') }}" style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
            ➕ Subir Nuevo Archivo
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="success">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Lista de archivos --}}
    @if($archivos->count() > 0)
        @foreach($archivos as $archivo)
            <div class="archivo">
                <h3>{{ $archivo->title }}</h3>
                <p><strong>Paciente:</strong> {{ $archivo->patient->name }}</p>
                <p><strong>Categoría:</strong> {{ $archivo->category->name }}</p>
                <p><strong>Archivo:</strong> {{ $archivo->original_name }}</p>
                <p><strong>Tamaño:</strong> {{ number_format($archivo->file_size / 1024, 2) }} KB</p>
                <p><strong>Subido:</strong> {{ $archivo->created_at->format('d/m/Y H:i') }}</p>
                
                <div class="acciones">
                    <a href="#" class="btn btn-ver">👁️ Ver</a>
                    <a href="#" class="btn btn-descargar">📥 Descargar</a>
                </div>
            </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 5px;">
            <h3>📭 No hay archivos médicos</h3>
            <p>No se han subido archivos médicos aún.</p>
            <a href="{{ route('medical-files.create') }}" class="btn">Subir el primer archivo</a>
        </div>
    @endif
</body>
</html>