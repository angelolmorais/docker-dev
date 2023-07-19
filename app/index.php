<?php
echo "<h1>Aplicação</h1>";

echo "A versão do PHP instalada é: <b>" . PHP_VERSION.'</b>';
echo "<br>";

$extensoesHabilitadas = get_loaded_extensions();
$extensoesString = implode(", ", $extensoesHabilitadas);
echo "Extensões habilitadas no PHP: " . $extensoesString;


echo "<br><br>";

echo "<b>Teste do Banco de Dados MySql<b><br>";
// Configurações de acesso ao MySQL
$host = 'mysql';
$port = '3307';
$dbname = 'db_myapp';
$username = 'root';
$password = 'my01';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT VERSION()";
    $result = $conn->query($query);
    $version = $result->fetchColumn();

    echo " - Conexão com o MySQL OK! <br><b>Versão:</b>" . $version;
} catch (PDOException $e) {
    echo " - Erro de conexão com o MySQL: " . $e->getMessage();
}

echo "<br><br>";

echo "<b>Teste do Banco de Dados PostgreSQL</b><br>";
// Configurações de acesso ao PostgreSQL
$pgHost = 'postgres';
$pgPort = '5432';
$pgDbname = 'db_pgapp';
$pgUsername = 'postgres';
$pgPassword = 'pg01';

try {
    $pgConn = new PDO("pgsql:host=$pgHost;port=$pgPort;dbname=$pgDbname;user=$pgUsername;password=$pgPassword");
    $pgConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT version()";
    $result = $pgConn->query($query);
    $version = $result->fetchColumn();


    echo " - Conexão com o PostgreSQL OK! <br><b>Versão:</b> " . $version; 
} catch (PDOException $e) {
    echo " - Erro de conexão com o PostgreSQL: " . $e->getMessage();
}

echo "<br><br>";

echo "<b>Teste do Banco de Dados Redis</b><br>";
// Configurações de acesso ao Redis
$redisHost = 'redis';
$redisPort = 6379;
$redisPassword = null;

$redis = new Redis();
$redis->connect($redisHost, $redisPort);
$redis->auth($redisPassword);

if ($redis->ping()) {
    $version = $redis->info('SERVER')['redis_version'];
    echo " - Conexão com o Redis OK! <br><b>Versão:</b> " . $version; 
} else {
    echo " - Erro de conexão ao Redis";
}

echo "<br><br>";

echo "<b>Teste do Banco de Dados MongoDB</b><br>";
// Configurações de acesso ao MongoDB
$mongoHost = 'mongo';
$mongoPort = 27017;
$mongoUsername = null;
$mongoPassword = null;

try {
    $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");
    $command = new MongoDB\Driver\Command(['buildInfo' => 1]);
    $cursor = $mongoManager->executeCommand('admin', $command);
    $result = current($cursor->toArray());

    $version = $result->version;

    echo " - Conexão com o MongoDB OK! <br><b>Versão:</b> " . $version; 
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo " - Erro de conexão com o MongoDB: " . $e->getMessage();
}
