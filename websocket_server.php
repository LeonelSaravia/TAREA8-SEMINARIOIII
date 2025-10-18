<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/WebSocket/AveriasWebSocket.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\AveriasWebSocket;

// Configuración del servidor
$port = 8080;
$host = '0.0.0.0';

echo "=== Servidor WebSocket de Averías ===\n";
echo "Iniciando servidor en {$host}:{$port}...\n";
echo "URL: ws://localhost:{$port}\n";
echo "Presiona Ctrl+C para detener el servidor\n";
echo "=====================================\n\n";

try {
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new AveriasWebSocket()
            )
        ),
        $port,
        $host
    );
    
    $server->run();
    
} catch (Exception $e) {
    echo "Error al iniciar el servidor: " . $e->getMessage() . "\n";
    exit(1);
}