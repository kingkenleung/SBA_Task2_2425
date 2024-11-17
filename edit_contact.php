<?php
include "connect_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['contact_name'] ?? '';
    $mobile = $_POST['contact_mobile'] ?? '';
    $remarks = $_POST['contact_remarks'] ?? '';
    $email = $_POST['contact_email'] ?? '';

    $stmt = $pdo->prepare("UPDATE sba_phonebook SET contact_name = :name, contact_mobile = :mobile, contact_remarks = :remarks, contact_email = :email WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':mobile' => $mobile,
        ':remarks' => $remarks,
        ':email' => $email,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

$id = $_GET['id'] ?? '';
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM sba_phonebook WHERE id = :id");
$stmt->execute([':id' => $id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>
    <div class="max-w-md mx-auto bg-white p-8 mt-10 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Contact</h2>
        <form method="POST" action="edit_contact.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($contact['id']); ?>">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="contact_name" required value="<?php echo htmlspecialchars($contact['contact_name']); ?>" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mobile</label>
                <input type="text" name="contact_mobile" required value="<?php echo htmlspecialchars($contact['contact_mobile']); ?>" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Remarks</label>
                <input type="text" name="contact_remarks" value="<?php echo htmlspecialchars($contact['contact_remarks']); ?>" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="contact_email" required value="<?php echo htmlspecialchars($contact['contact_email']); ?>" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">Update Contact</button>
        </form>
    </div>
</body>

</html>