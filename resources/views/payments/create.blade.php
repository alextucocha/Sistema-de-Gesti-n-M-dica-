<!DOCTYPE html>
<html>
<head>
    <title>Procesar Pago</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 50px auto; padding: 20px; }
        .campo { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <h1>💳 Procesar Pago</h1>

    <form method="POST" action="{{ route('payments.store') }}">
        @csrf
        
        <div class="campo">
            <label>Monto a Pagar:</label>
            <input type="number" step="0.01" name="amount" placeholder="Ej: 500.00" required>
        </div>
        
        <div class="campo">
            <label>Método de Pago:</label>
            <select name="payment_method" required>
                <option value="">Selecciona método</option>
                <option value="credit_card">💳 Tarjeta de Crédito</option>
                <option value="debit_card">💳 Tarjeta de Débito</option>
                <option value="paypal">📧 PayPal</option>
                <option value="cash">💵 Efectivo</option>
            </select>
        </div>

        <div class="campo">
            <label>Descripción:</label>
            <input type="text" name="description" placeholder="Ej: Pago por consulta médica">
        </div>

        <button type="submit">✅ Procesar Pago</button>
    </form>

    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
        <h3>💡 Solo pedimos lo esencial:</h3>
        <p><strong>Monto:</strong> ¿Cuánto se va a pagar?</p>
        <p><strong>Método:</strong> ¿Cómo se va a pagar?</p>
        <p><strong>Descripción:</strong> ¿Por qué se paga?</p>
        <p><em>El sistema guardará: fecha, ID de transacción, estado, etc.</em></p>
    </div>
</body>
</html>