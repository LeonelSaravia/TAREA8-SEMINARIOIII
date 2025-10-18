<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Avería - Sistema de Gestión</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
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
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .form-control {
            border: 2px solid #ecf0f1;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .card-header {
            background: linear-gradient(45deg, var(--primary), var(--dark));
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
        
        .back-btn {
            background: linear-gradient(45deg, #95a5a6, #7f8c8d);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(149, 165, 166, 0.4);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="glass-card">
            <div class="card-header text-center">
                <h2 class="mb-0 fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>Registrar Nueva Avería
                </h2>
                <p class="mb-0 mt-2 opacity-75">Complete el formulario para registrar una nueva solicitud</p>
            </div>
            
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Por favor corrija los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('averias/guardar') ?>" method="post">
                    <div class="mb-4">
                        <label for="cliente" class="form-label fw-semibold">
                            <i class="fas fa-user me-2 text-primary"></i>Nombre del Cliente
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="cliente" 
                               name="cliente" 
                               value="<?= old('cliente') ?>"
                               placeholder="Ingrese el nombre del cliente"
                               required>
                        <div class="form-text">Máximo 50 caracteres permitidos</div>
                    </div>

                    <div class="mb-4">
                        <label for="problema" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Descripción del Problema
                        </label>
                        <textarea class="form-control" 
                                  id="problema" 
                                  name="problema" 
                                  rows="4"
                                  placeholder="Describa el problema técnico encontrado"
                                  required><?= old('problema') ?></textarea>
                        <div class="form-text">Máximo 100 caracteres permitidos</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('averias/listar') ?>" class="back-btn me-md-2">
                            <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Registrar Avería
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>