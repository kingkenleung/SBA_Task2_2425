<?php

$host = getenv('db_host') ?: "";
$db   = getenv('db_name') ?: "";
$port = getenv('db_port') ?: "";
$user = getenv('db_user') ?: "";
$pass = getenv('db_password') ?: "";

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM sba_phonebook");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>SBA Phonebook</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">SBA Phonebook</h1>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <?php if (!empty($rows)): ?>
                        <?php foreach (array_keys($rows[0]) as $header): ?>
                            <th class="py-2 px-4 border-b"><?= htmlspecialchars($header) ?></th>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td class="py-2 px-4 border-b"><?= htmlspecialchars($cell) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>