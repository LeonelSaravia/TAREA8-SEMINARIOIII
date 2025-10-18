Sistema de Gestión de Averías
=============================

Sistema web desarrollado en CodeIgniter 4 para la gestión de averías con actualizaciones en tiempo real mediante WebSockets.

Descripción
-----------

Este sistema permite registrar, listar y gestionar averías de clientes con las siguientes características:

*   Registro de nuevas averías con cliente y descripción del problema
    
*   Fecha y hora automática del sistema
    
*   Estado automático inicial como "pendiente"
    
*   Listado de todas las averías con posibilidad de cambiar estados
    
*   Actualizaciones en tiempo real sin necesidad de refrescar la página
    
*   Comunicación bidireccional mediante WebSockets
    

Características Principales
---------------------------

### Funcionalidades del Sistema

*   **Registro de Averías**: Formulario simple para registrar cliente y problema
    
*   **Listado Dinámico**: Vista de todas las averías con filtros por estado
    
*   **Cambio de Estados**: Posibilidad de marcar averías como solucionadas o pendientes
    
*   **Tiempo Real**: Actualizaciones instantáneas entre múltiples navegadores
    
*   **Contadores Automáticos**: Estadísticas en tiempo real de averías pendientes y solucionadas
    

### Tecnologías Utilizadas

*   **Backend**: CodeIgniter 4, PHP 8.1+
    
*   **Frontend**: Bootstrap 5, JavaScript ES6
    
*   **Base de Datos**: MySQL/MariaDB
    
*   **WebSockets**: Ratchet (ReactPHP)
    
*   **Tiempo Real**: WebSocket Server personalizado
    

Instalación
-----------

### Requisitos Previos

*   PHP 8.1 o superior
    
*   Composer
    
*   MySQL/MariaDB
    
*   Servidor web (Apache/Nginx)
    

### Pasos de Instalación

1.  bashgit clone cd nombre-proyecto
    
2.  bash composer installcomposer require cboden/ratchet
    
3.  **Configurar el entorno**
    
    *   Copiar .env.example a .env
        
    *   textdatabase.default.hostname = localhostdatabase.default.database = WOWDBdatabase.default.username = tu\_usuariodatabase.default.password = tu\_contraseñadatabase.default.DBDriver = MySQLi
        
4.  sqlCREATE DATABASE WOWDB;USE WOWDB;CREATE TABLE averias ( id INT AUTO\_INCREMENT PRIMARY KEY, cliente VARCHAR(50) NOT NULL, problema VARCHAR(100) NOT NULL, fechaHora DATETIME NOT NULL, status ENUM('pendiente', 'solucionado') DEFAULT 'pendiente');
    

Uso del Sistema
---------------

### Iniciar el Servidor WebSocket

Para habilitar las actualizaciones en tiempo real, debe iniciarse el servidor WebSocket:

bash

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php websocket_server.php   `

El servidor se ejecutará en el puerto 8080 y mostrará:

text

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   === Servidor WebSocket de Averías ===  Servidor iniciado en puerto 8080  URL: ws://localhost:8080  Presiona Ctrl+C para detener el servidor   `

### Iniciar Servidor CodeIgniter

bash

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php spark serve   `

### Acceder al Sistema

1.  **Registrar Averías**: http://localhost:8080/averias/registrar
    
2.  **Listar Averías Pendientes**: http://localhost:8080/averias/listar
    
3.  **Ver Averías Atendidas**: http://localhost:8080/averias/atendidos
    

### Funcionalidades Principales

#### Registro de Averías

*   Acceder al formulario de registro
    
*   Completar los campos: Cliente y Problema
    
*   La fecha, hora y estado se asignan automáticamente
    
*   Al guardar, se redirige a la lista y se notifica en tiempo real
    

#### Gestión de Averías

*   Ver todas las averías en una tabla responsive
    
*   Cambiar estado entre "pendiente" y "solucionado"
    
*   Ver contadores automáticos de estados
    
*   Recibir actualizaciones en tiempo real sin refrescar
    

Estructura del Proyecto
-----------------------

text

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   app/  ├── Controllers/  │   └── Averias.php          # Controlador principal  ├── Models/  │   └── AveriasModel.php     # Modelo de datos  ├── Views/  │   └── averias/  │       ├── listar.php       # Vista de listado  │       ├── atendidos.php    # Vista de atendidos  │       └── registrar.php    # Vista de registro  ├── WebSocket/  │   └── AveriasWebSocket.php # Servidor WebSocket  ├── Libraries/  │   └── WebSocketClient.php  # Cliente WebSocket  └── Config/      └── Routes.php           # Configuración de rutas  websocket_server.php         # Servidor WebSocket independiente   `

Arquitectura WebSocket
----------------------

### Flujo de Comunicación

1.  **Registro de Avería**:
    
    *   Usuario completa formulario → Controlador guarda en BD → Notifica WebSocket → Actualiza todas las vistas conectadas
        
2.  **Cambio de Estado**:
    
    *   Usuario cambia estado → Controlador actualiza BD → Notifica WebSocket → Actualiza todas las vistas conectadas
        

### Componentes WebSocket

*   **AveriasWebSocket.php**: Servidor que maneja conexiones y mensajes
    
*   **WebSocketClient.php**: Cliente que envía notificaciones desde PHP
    
*   **JavaScript Client**: Código frontend que recibe actualizaciones en tiempo real
    

Problemas Comunes
-----------------

1.  **WebSocket no conecta**:
    
    *   Verificar que el servidor esté ejecutándose: php websocket\_server.php
        
    *   Comprobar que el puerto 8080 esté disponible
        
    *   Revisar la consola del navegador para errores
        
2.  **Error de base de datos**:
    
    *   Verificar configuración de base de datos en .env
        
    *   Asegurar que la base de datos existe
        
    *   Comprobar permisos del usuario de BD
        
3.  **No se muestran actualizaciones**:
    
    *   Verificar conexión WebSocket en consola del navegador
        
    *   Comprobar que el servidor WebSocket esté activo
        
    *   Revisar logs del servidor para errores
        
4.  **Error "Invalid file: atendidos.php"**:
    
    *   Verificar que el archivo existe en app/Views/averias/atendidos.php
        
    *   Limpiar cache: php spark cache:clear