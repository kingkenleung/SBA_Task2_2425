<?php
include "connect_db.php";
$stmt = $pdo->query("SELECT * FROM sba_phonebook");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Phonebook</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4 mt-4">Search Contact</h1>
        <input type="text" id="search_input"></input>
        <?php
        echo '<table class="min-w-full bg-white">';
        echo '<thead><tr>';
        if (!empty($rows)) {
            foreach (array_keys($rows[0]) as $header) {
                echo '<th class="py-2 px-4 border-b">' . htmlspecialchars($header) . '</th>';
            }
            echo '<th class="py-2 px-4 border-b">Actions</th>';
        }
        echo '</tr></thead>';
        echo '<tbody>';
        foreach ($rows as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($cell) . '</td>';
            }
            echo '<td class="py-2 px-4 border-b"><a href="edit_contact.php?id=' . htmlspecialchars($row['id']) . '" class="text-blue-500">Edit</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // const searchInput = document.createElement('input');
        const searchInput = document.getElementById('search_input');
        searchInput.placeholder = 'Search...';
        searchInput.className = 'mb-4 p-2 border border-gray-300 rounded';

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let match = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                    }
                });
                row.style.display = match ? '' : 'none';
            });
        });
    });
</script>