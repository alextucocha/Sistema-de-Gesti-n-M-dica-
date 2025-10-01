<!DOCTYPE html>
<html>
<head>
    <title>Nueva Factura</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 50px auto; padding: 20px; }
        .campo { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🧾 Nueva Factura Médica</h1>

    <form method="POST" action="{{ route('invoices.store') }}">
        @csrf
        
        <div class="campo">
            <label>ID del Paciente:</label>
            <input type="number" name="patient_id" placeholder="Ej: 1, 2, 3..." required>
            <small>El número de identificación del paciente</small>
        </div>
        
        <div class="campo">
            <label>Concepto Principal:</label>
            <input type="text" name="concept" placeholder="Ej: Consulta médica, Radiografía..." required>
        </div>
        
        <div class="campo">
            <label>Monto Total:</label>
            <input type="number" step="0.01" name="total" placeholder="Ej: 500.00" required>
            <small>Precio total de la consulta o servicio</small>
        </div>

        <button type="submit">💾 Crear Factura</button>
    </form>

    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
        <h3>💡 Solo pedimos lo esencial:</h3>
        <p><strong>Patient ID:</strong> ¿A qué paciente le facturamos?</p>
        <p><strong>Concepto:</strong> ¿Por qué le facturamos?</p>
        <p><strong>Monto:</strong> ¿Cuánto le cobramos?</p>
        <p><em>El sistema completará automáticamente: fecha, folio, IVA, etc.</em></p>
    </div>
</body>
</html>