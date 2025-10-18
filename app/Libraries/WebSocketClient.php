<?php

namespace App\Libraries;

class WebSocketClient
{
    private $host;
    private $port;
    private $timeout;

    public function __construct($host = 'localhost', $port = 8080, $timeout = 5)
    {
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    /**
     * Enviar mensaje al servidor WebSocket (versión simplificada)
     */
    public function sendMessage($data)
    {
        try {
            // Usar fsockopen para una conexión más simple
            $socket = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
            
            if (!$socket) {
                throw new \Exception("No se pudo conectar al servidor WebSocket: {$errstr} ({$errno})");
            }

            // Crear handshake WebSocket básico
            $key = base64_encode(random_bytes(16));
            $handshake = "GET / HTTP/1.1\r\n" .
                        "Host: {$this->host}:{$this->port}\r\n" .
                        "Upgrade: websocket\r\n" .
                        "Connection: Upgrade\r\n" .
                        "Sec-WebSocket-Key: {$key}\r\n" .
                        "Sec-WebSocket-Version: 13\r\n\r\n";

            fwrite($socket, $handshake);
            
            // Leer respuesta del handshake
            $response = fread($socket, 1024);
            
            if (strpos($response, '101 Switching Protocols') === false) {
                throw new \Exception('Handshake WebSocket falló');
            }

            // Enviar mensaje JSON simple
            $message = json_encode($data) . "\n";
            fwrite($socket, $message);

            // Cerrar conexión
            fclose($socket);
            
            return true;

        } catch (\Exception $e) {
            error_log("Error WebSocket Client: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Notificar nueva avería
     */
    public function notifyNewAveria($averia)
    {
        return $this->sendMessage([
            'type' => 'new_averia',
            'averia' => $averia
        ]);
    }

    /**
     * Notificar actualización de estado
     */
    public function notifyStatusUpdate($averia)
    {
        return $this->sendMessage([
            'type' => 'status_update',
            'averia' => $averia
        ]);
    }
}