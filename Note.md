<!-- prepare é usado para por itens que serão substituidos depois
$res->prepare('INSERT INTO dbname(itens do banco de dados) VALUES (itens dado para os itens que serão substituidos)');

query aceita apenas se for feito diretamente nele, nunca pode ser substituido!
$res->query('INSERT INTO dbname(itens do banco de dados) VALUES (itens que serão diretamente implementados "no" banco de dados )');

try {
$pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", "");
} catch (PDOException $e) {
    echo 'Erro no banco de dados';
} catch (Exception $e) {
    echo 'Erro genérico';
}
$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:nome, :telefone, :email)");

$res->bindValue(":nome", "EriLideme");
$res->bindValue(":telefone", "21323123213");
$res->bindValue(":email", "ericlideme@hotmail.com");
$res->execute();

--------------------------- Delete e Update ------------------------------

$res = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$value = 34;
$res->bindValue(':id', 42);
$res->execute();

$res = $pdo->query("DELETE FROM pessoa WHERE id = '43'");

$pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost;", "root", "");

$cdm = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");

$cdm->bindValue("id", 47);
$cdm->execute();

$cdm = $pdo->query("DELETE FROM pessoa WHERE id = '46' ");

--------------------------- Update ------------------------------

$pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", '');

$cdm = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$cdm->bindValue(":e", "EloiseDoCarmos@hotmail.com");
$cdm->bindValue(":id", 46);
$cdm->execute();

$cdm = $pdo->query("UPDATE pessoa SET telefone = '(15) 2330504' WHERE id = '47' ");

--------------------------- Select ----------------------------------------

$pdo = new PDO('mysql:dbname=CRUDPDO;host=localhost', 'root', '');

$cdm = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cdm->bindValue("id", 47);
$cdm->execute();
 fetchAll() - Seleciona todos
fetch() - Seleciona apenas um
$res = $cdm->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($res);
echo "</pre>";

foreach ($res as $key => $value) {
    echo $key.": ".$value."<br>";
} -->
