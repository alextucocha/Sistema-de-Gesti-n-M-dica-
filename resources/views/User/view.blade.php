<!DOCTYPE html>
<html>
<head>
    <title>Ver Usuario</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 20px auto; padding: 20px; }
        input, button { padding: 8px; margin: 5px; }
        .usuario { background: #f9f9f9; padding: 15px; margin-top: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>👁️ Ver Usuario</h1>
    
    <div>
        <input type="number" id="userId" placeholder="ID del usuario">
        <button onclick="verUsuario()">Ver Usuario</button>
    </div>
    
    <div id="usuarioInfo"></div>

    <script>
        async function verUsuario() {
            const userId = document.getElementById('userId').value;
            
            if (!userId) {
                alert('Ingresa un ID');
                return;
            }

            try {
                const respuesta = await fetch(`http://localhost:8000/api/users/${userId}`);
                const usuario = await respuesta.json();
                
                let html = '<div class="usuario">';
                html += `<strong>${usuario.name}</strong> (${usuario.role})<br>`;
                html += `Email: ${usuario.email}<br>`;
                html += `Teléfono: ${usuario.phone || 'N/A'}<br>`;
                html += `Activo: ${usuario.is_active ? 'Sí' : 'No'}`;
                html += '</div>';
                
                document.getElementById('usuarioInfo').innerHTML = html;
            } catch (error) {
                document.getElementById('usuarioInfo').innerHTML = '❌ Error al cargar usuario';
            }
        }
    </script>
</body>
</html>