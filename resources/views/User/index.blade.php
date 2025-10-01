<!DOCTYPE html>
<html>
<head>
    <title>Listar Usuarios</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 20px auto; padding: 20px; }
        .user-card { background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 4px; }
        .filters { margin-bottom: 20px; }
        input, select { padding: 8px; margin-right: 10px; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>📋 Listar Usuarios</h1>
    
    <div class="filters">
        <input type="text" id="search" placeholder="Buscar...">
        <select id="role">
            <option value="">Todos</option>
            <option value="medico">Médicos</option>
            <option value="paciente">Pacientes</option>
        </select>
        <button onclick="cargarUsuarios()">Buscar</button>
    </div>
    
    <div id="resultados"></div>

    <script>
        async function cargarUsuarios() {
            const search = document.getElementById('search').value;
            const role = document.getElementById('role').value;
            
            let url = 'http://localhost:8000/api/users?';
            if (search) url += 'search=' + search + '&';
            if (role) url += 'role=' + role;

            const respuesta = await fetch(url);
            const datos = await respuesta.json();
            
            let html = '';
            datos.data.forEach(usuario => {
                html += `<div class="user-card">
                    <strong>${usuario.name}</strong> (${usuario.role})<br>
                    Email: ${usuario.email}<br>
                    Tel: ${usuario.phone || 'N/A'}
                </div>`;
            });
            
            document.getElementById('resultados').innerHTML = html;
        }

        // Cargar al iniciar
        cargarUsuarios();
    </script>
</body>
</html>