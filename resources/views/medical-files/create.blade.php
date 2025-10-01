<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo Médico</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 50px auto; padding: 20px; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>📄 Subir Archivo Médico</h1>

    {{-- Mostrar mensajes de éxito --}}
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('medical-files.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>ID del Paciente:</label>
            <input type="number" name="patient_id" placeholder="Ej: 1, 2, 3..." required>
            <small>Ingresa el ID numérico del paciente</small>
        </div>
        
        <div>
            <label>Categoría:</label>
            <select name="category_id" required>
                <option value="">Selecciona categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label>Título del archivo:</label>
            <input type="text" name="title" placeholder="Ej: Radiografía de tórax" required>
        </div>
        
        <div>
            <label>Archivo médico:</label>
            <input type="file" name="file" required>
            <small>Formatos: PDF, JPG, PNG (máx. 50MB)</small>
        </div>
        
        <button type="submit">📤 Subir Archivo Médico</button>
    </form>

    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
        <h3>💡 Para probar:</h3>
        <p><strong>Patient ID:</strong> Usa el ID de un paciente que exista en tu BD</p>
        <p><strong>Categoría:</strong> Selecciona una de la lista</p>
        <p><strong>Archivo:</strong> Sube cualquier PDF o imagen</p>
    </div>
</body>
</html>