<!DOCTYPE html>
<html>
<head>
    <title>Facturas Médicas</title>
    <style>
        body { font-family: Arial; max-width: 1200px; margin: 20px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .factura { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .estado { padding: 5px 10px; border-radius: 3px; font-size: 12px; font-weight: bold; }
        .pendiente { background: #fff3cd; color: #856404; }
        .pagada { background: #d4edda; color: #155724; }
        .vencida { background: #f8d7da; color: #721c24; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-right: 5px; }
        .btn-ver { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🧾 Facturas Médicas</h1>
        <a href="{{ route('invoices.create') }}" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
            ➕ Nueva Factura
        </a>
    </div>

    @if($facturas->count() > 0)
        @foreach($facturas as $factura)
            <div class="factura">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>Factura: {{ $factura->folio }}</h3>
                    <span class="estado {{ $factura->status }}">
                        {{ strtoupper($factura->status) }}
                    </span>
                </div>
                
                <p><strong>Paciente:</strong> {{ $factura->patient->name ?? 'N/A' }}</p>
                <p><strong>Médico:</strong> {{ $factura->doctor->name ?? 'N/A' }}</p>
                <p><strong>Fecha:</strong> {{ $factura->issue_date->format('d/m/Y') }}</p>
                <p><strong>Total:</strong> ${{ number_format($factura->total, 2) }}</p>
                <p><strong>Concepto:</strong> {{ Str::limit($factura->concept, 50) }}</p>
                
                <div style="margin-top: 10px;">
                    <a href="{{ route('invoices.show', $factura) }}" class="btn btn-ver">👁️ Ver Detalles</a>
                </div>
            </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 5px;">
            <h3>📭 No hay facturas</h3>
            <p>No se han creado facturas aún.</p>
            <a href="{{ route('invoices.create') }}" class="btn">Crear primera factura</a>
        </div>
    @endif
</body>
</html>