<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Averías Atendidas - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #34495e;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-glass {
            background: rgba(44, 62, 80, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .table-hover tbody tr:hover {
            background: rgba(39, 174, 96, 0.1);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        
        .badge-solucionado {
            background: linear-gradient(45deg, #27ae60, #229954);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .status-solucionado { background-color: #27ae60; }
        
        .card-header {
            background: linear-gradient(45deg, var(--success), #229954);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .ws-indicator {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1000;
            padding: 10px 15px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            box-shadow: 0 5px 25px rgba(52, 152, 219, 0.5);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-glass">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-tools me-2"></i>Sistema de Averías
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= base_url('averias/listar') ?>">
                    <i class="fas fa-list me-1"></i>Pendientes
                </a>
                <a class="nav-link active" href="<?= base_url('averias/atendidos') ?>">
                    <i class="fas fa-check-circle me-1"></i>Atendidos
                </a>
                <a class="nav-link" href="<?= base_url('averias/registrar') ?>">
                    <i class="fas fa-plus me-1"></i>Nueva
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="glass-card p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-check-circle text-success me-2"></i>Averías Atendidas
                            </h2>
                            <p class="text-muted mb-0">Historial de solicitudes ya solucionadas</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="stat-card">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h3 class="fw-bold mb-0" id="total-atendidas"><?= count($averias) ?></h3>
                                        <small>Total Atendidas</small>
                                    </div>
                                    <div class="col-6">
                                        <h3 class="fw-bold mb-0">
                                            <i class="fas fa-sync-alt fa-spin"></i>
                                        </h3>
                                        <small>Tiempo Real</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="glass-card">
                    <div class="card-body">
                        <?php if (empty($averias)): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-4x text-muted mb-4"></i>
                                <h4 class="text-muted">No hay averías atendidas</h4>
                                <p class="text-muted">Las averías solucionadas aparecerán aquí automáticamente</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-success">
                                        <tr>
                                            <th scope="col" class="ps-4">#</th>
                                            <th scope="col">
                                                <i class="fas fa-user me-2"></i>Cliente
                                            </th>
                                            <th scope="col">
                                                <i class="fas fa-exclamation-triangle me-2"></i>Problema
                                            </th>
                                            <th scope="col">
                                                <i class="fas fa-calendar me-2"></i>Fecha y Hora
                                            </th>
                                            <th scope="col" class="text-center">
                                                <i class="fas fa-flag me-2"></i>Estado
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-atendidos">
                                        <?php foreach ($averias as $averia): ?>
                                            <tr class="fade-in" data-id="<?= $averia['id'] ?>">
                                                <th scope="row" class="ps-4 fw-bold"><?= $averia['id'] ?></th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-indicator status-solucionado"></div>
                                                        <strong><?= esc($averia['cliente']) ?></strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark"><?= esc($averia['problema']) ?></span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>
                                                        <?= date('d/m/Y H:i', strtotime($averia['fechaHora'])) ?>
                                                    </small>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-solucionado">
                                                        <i class="fas fa-check me-1"></i>SOLUCIONADO
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <a href="<?= base_url('averias/registrar') ?>" class="btn btn-primary btn-lg floating-btn">
        <i class="fas fa-plus me-2"></i>Nueva Avería
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // WebSocket para actualizaciones en tiempo real
        let socket = null;
        let reconnectInterval = null;

        function connectWebSocket() {
            try {
                // Usar el mismo host y puerto de tu aplicación
                const wsHost = window.location.hostname;
                const wsPort = '8080';
                const wsUrl = `ws://${wsHost}:${wsPort}`;
                
                console.log('Intentando conectar a:', wsUrl);
                socket = new WebSocket(wsUrl);
                
                socket.onopen = function(event) {
                    console.log('✅ Conectado al servidor WebSocket - Vista Atendidos');
                    clearInterval(reconnectInterval);
                    showConnectionStatus(true);
                };

                socket.onmessage = function(event) {
                    try {
                        const data = JSON.parse(event.data);
                        console.log('📨 Mensaje recibido en atendidos:', data);
                        
                        if (data.type === 'status_update') {
                            addAveriaToTable(data.averia);
                            showNotification('Nueva avería solucionada: ' + data.averia.cliente, 'success');
                        }
                    } catch (e) {
                        console.error('Error procesando mensaje WebSocket:', e);
                    }
                };

                socket.onclose = function(event) {
                    console.log('🔴 Conexión WebSocket cerrada - Vista Atendidos');
                    showConnectionStatus(false);
                    reconnectInterval = setInterval(connectWebSocket, 5000);
                };

                socket.onerror = function(error) {
                    console.error('❌ Error WebSocket:', error);
                    showConnectionStatus(false);
                };

            } catch (error) {
                console.error('❌ Error al conectar WebSocket:', error);
                showConnectionStatus(false);
                reconnectInterval = setInterval(connectWebSocket, 5000);
            }
        }

        function addAveriaToTable(averia) {
            const tableBody = document.getElementById('tabla-atendidos');
            if (!tableBody) return;

            // Si no hay averías, remover el mensaje de "no hay averías"
            const emptyMessage = document.querySelector('.text-center.py-5');
            if (emptyMessage) {
                emptyMessage.remove();
            }

            // Crear nueva fila
            const newRow = document.createElement('tr');
            newRow.className = 'fade-in table-success';
            newRow.setAttribute('data-id', averia.id);
            
            const fechaFormateada = new Date(averia.fechaHora).toLocaleString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            newRow.innerHTML = `
                <th scope="row" class="ps-4 fw-bold">${averia.id}</th>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="status-indicator status-solucionado"></div>
                        <strong>${escapeHtml(averia.cliente)}</strong>
                    </div>
                </td>
                <td>${escapeHtml(averia.problema)}</td>
                <td>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>${fechaFormateada}
                    </small>
                </td>
                <td class="text-center">
                    <span class="badge-solucionado">
                        <i class="fas fa-check me-1"></i>SOLUCIONADO
                    </span>
                </td>
            `;

            // Insertar al inicio de la tabla
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Quitar resaltado después de 3 segundos
            setTimeout(() => {
                newRow.classList.remove('table-success');
            }, 3000);

            // Actualizar contador
            updateCounter(1);
        }

        function updateCounter(change) {
            const counterElement = document.getElementById('total-atendidas');
            if (counterElement) {
                const currentCount = parseInt(counterElement.textContent) || 0;
                const newCount = Math.max(0, currentCount + change);
                counterElement.textContent = newCount;
                
                // Animación del contador
                counterElement.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    counterElement.style.transform = 'scale(1)';
                }, 300);
            }
        }

        function showConnectionStatus(connected) {
            let indicator = document.getElementById('ws-indicator');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.id = 'ws-indicator';
                indicator.className = 'ws-indicator';
                document.body.appendChild(indicator);
            }

            if (connected) {
                indicator.innerHTML = '🟢 CONECTADO - TIEMPO REAL';
                indicator.style.background = 'linear-gradient(45deg, #27ae60, #229954)';
                indicator.style.color = 'white';
            } else {
                indicator.innerHTML = '🔴 RECONECTANDO...';
                indicator.style.background = 'linear-gradient(45deg, #e74c3c, #c0392b)';
                indicator.style.color = 'white';
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                z-index: 9998;
                min-width: 300px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            `;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Inicializar WebSocket cuando se carga la página
        document.addEventListener('DOMContentLoaded', function() {
            connectWebSocket();
        });

        window.addEventListener('beforeunload', function() {
            if (socket) {
                socket.close();
            }
        });
    </script>
</body>
</html>