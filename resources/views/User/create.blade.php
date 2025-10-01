<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        div { margin-bottom: 15px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; }
        .mensaje { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .exito { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>➕ Crear Usuario</h1>
    
    <form onsubmit="crearUsuario(event)">
        <div>
            <label>Nombre:</label>
            <input type="text" name="name" required>
        </div>
        
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        
        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        
        <div>
            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        
        <div>
            <label>Rol:</label>
            <select name="role" required>
                <option value="paciente">Paciente</option>
                <option value="medico">Médico</option>
                <option value="administrador">Administrador</option>
            </select>
        </div>

        <button type="submit">Crear Usuario</button>
    </form>

    <div id="mensaje"></div>

    <script>
        async function crearUsuario(event) {
            event.preventDefault();
            
            const form = event.target;
            const datos = new FormData(form);
            const datosJSON = Object.fromEntries(datos.entries());

            try {
                const respuesta = await fetch('http://localhost:8000/api/users', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(datosJSON)
                });

                const resultado = await respuesta.json();
                
                const mensaje = document.getElementById('mensaje');
                if (respuesta.ok) {
                    mensaje.innerHTML = '<div class="mensaje exito">✅ Usuario creado exitosamente</div>';
                    form.reset();
                } else {
                    mensaje.innerHTML = `<div class="mensaje error">❌ Error: ${resultado.message}</div>`;
                }
            } catch (error) {
                document.getElementById('mensaje').innerHTML = `<div class="mensaje error">❌ Error: ${error.message}</div>`;
            }
        }
    </script>
</body>
</html>