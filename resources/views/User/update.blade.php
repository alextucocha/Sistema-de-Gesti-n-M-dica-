<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        input, button { padding: 8px; margin: 5px; }
        .mensaje { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .exito { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        #formulario { margin-top: 15px; }
    </style>
</head>
<body>
    <h1>✏️ Editar Usuario</h1>
    
    <div>
        <input type="number" id="userId" placeholder="ID del usuario a editar">
        <button onclick="cargarUsuario()">Cargar Usuario</button>
    </div>
    
    <form id="formulario" style="display: none;" onsubmit="actualizarUsuario(event)">
        <div>
            <label>Nombre:</label>
            <input type="text" name="name">
        </div>
        
        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>
        
        <div>
            <label>Teléfono:</label>
            <input type="text" name="phone">
        </div>
        
        <button type="submit">Actualizar Usuario</button>
    </form>
    
    <div id="mensaje"></div>

    <script>
        async function cargarUsuario() {
            const userId = document.getElementById('userId').value;
            
            if (!userId) {
                mostrarMensaje('❌ Ingresa un ID de usuario', 'error');
                return;
            }

            try {
                const respuesta = await fetch(`http://localhost:8000/api/users/${userId}`);
                const usuario = await respuesta.json();
                
                document.getElementById('formulario').style.display = 'block';
                document.querySelector('input[name="name"]').value = usuario.name;
                document.querySelector('input[name="email"]').value = usuario.email;
                document.querySelector('input[name="phone"]').value = usuario.phone || '';
                
            } catch (error) {
                mostrarMensaje('❌ Error al cargar usuario', 'error');
            }
        }

        async function actualizarUsuario(event) {
            event.preventDefault();
            
            const userId = document.getElementById('userId').value;
            const form = event.target;
            const datos = new FormData(form);
            const datosJSON = Object.fromEntries(datos.entries());

            try {
                const respuesta = await fetch(`http://localhost:8000/api/users/${userId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(datosJSON)
                });

                const resultado = await respuesta.json();
                
                if (respuesta.ok) {
                    mostrarMensaje('✅ Usuario actualizado exitosamente', 'exito');
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