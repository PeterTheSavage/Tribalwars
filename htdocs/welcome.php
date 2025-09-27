<?php
/**
 * Tribalwars - Welcome Page for Plesk Setup
 */

// Check if installation is needed
$needsInstallation = true;
if (file_exists('configs/install.php')) {
    include 'configs/install.php';
    if (isset($install) && $install) {
        $needsInstallation = false;
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tribalwars - Server Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: rgba(139, 69, 19, 0.9);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border: 2px solid #8B4513;
        }
        .logo {
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px;
            background: #654321;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            border: 1px solid #8B4513;
        }
        .btn:hover {
            background: #8B4513;
        }
        .btn-primary {
            background: #2E8B57;
            border-color: #3CB371;
        }
        .btn-primary:hover {
            background: #3CB371;
        }
        .status {
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
        }
        .status.warning {
            background: rgba(255, 165, 0, 0.2);
            border: 1px solid #FFA500;
        }
        .status.success {
            background: rgba(0, 128, 0, 0.2);
            border: 1px solid #00FF00;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>🏰 Tribalwars</h1>
            <p>Bem-vindo ao servidor de Tribos<br><small>Versão otimizada para Plesk</small></p>
        </div>
        
        <?php if ($needsInstallation): ?>
        <div class="status warning">
            <h3>⚙️ Instalação Necessária</h3>
            <p>O servidor ainda não foi configurado. Execute a instalação para começar.</p>
        </div>
        
        <div>
            <a href="install.php" class="btn btn-primary">🚀 Iniciar Instalação</a>
            <a href="plesk_setup.php" class="btn">🔧 Verificar Configuração</a>
        </div>
        
        <?php else: ?>
        <div class="status success">
            <h3>✅ Servidor Configurado</h3>
            <p>O servidor está pronto para uso!</p>
        </div>
        
        <div>
            <a href="index.php" class="btn btn-primary">🎮 Entrar no Jogo</a>
            <a href="admin.php" class="btn">⚙️ Painel Admin</a>
            <a href="plesk_setup.php" class="btn">🔧 Verificação do Sistema</a>
        </div>
        <?php endif; ?>
        
        <div class="footer">
            <p>Tribalwars - Versão Otimizada para Plesk<br>
            <small>Suporte: <a href="https://github.com/PeterTheSavage/Tribalwars" style="color: #90EE90;">GitHub</a></small></p>
        </div>
    </div>
</body>
</html>