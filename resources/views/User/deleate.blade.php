<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Usuario</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        input, button { padding: 8px; margin: 5px; }
        .mensaje { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .exito { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>🗑️ Eliminar Usuario</h1>
    
    <div>
        <input type="number" id="userId" placeholder="ID del usuario a eliminar">
        <button onclick="eliminarUsuario()">Eliminar Usuario</button>
    </div>
    
    <div id="mensaje"></div>

    <script>
        async function eliminarUsuario() {
            const userId = document.getElementById('userId').value;
            
            if (!userId) {
                mostrarMensaje('❌ Ingresa un ID de usuario', 'error');
                return;
            }

            if (!confirm('¿Estás SEGURO de que quieres eliminar este usuario? Esta acción no se puede deshacer.')) {
                return;
            }

            try {
                const respuesta = await fetch(`http://localhost:8000/api/users/${userId}`, {
                    method: 'DELETE'
                });

                const resultado = await respuesta.json();
                
                if (respuesta.ok) {
                    mostrarMensaje('✅ Usuario eliminado exitosamente', 'exito');
                    document.getElementById('userId').value = '';
                } else {
                    mostrarMensaje('❌ Error: ' + resultado.message, 'error');
                }
            } catch (error) {
                mostrarMensaje('❌ Error: ' + error.message, 'error');
            }
        }

        function mostrarMensaje(texto, tipo) {
            const mensaje = document.getElementById('mensaje');
            mensaje.innerHTML = `<div class="mensaje ${tipo}">${texto}</div>`;
        }
    </script>
</body>
</html>