<?php
include "connect_db.php";
/*
Data structure of sba_phonebook:
id	contact_name	contact_mobile	contact_remarks	contact_email
1	Ken Leung	99999999	SPYC Teacher	lkh1@school.pyc.edu.hk
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['contact_name'] ?? '';
    $mobile = $_POST['contact_mobile'] ?? '';
    $remarks = $_POST['contact_remarks'] ?? '';
    $email = $_POST['contact_email'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO sba_phonebook (contact_name, contact_mobile, contact_remarks, contact_email) VALUES (:name, :mobile, :remarks, :email)");
    $stmt->execute([
        ':name' => $name,
        ':mobile' => $mobile,
        ':remarks' => $remarks,
        ':email' => $email
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Add New Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>
    <div class="max-w-md mx-auto bg-white p-8 mt-10 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Add New Contact</h2>
        <form method="POST" action="add_contact.php">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="contact_name" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mobile</label>
                <input type="text" name="contact_mobile" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Remarks</label>
                <input type="text" name="contact_remarks" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="contact_email" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">Add Contact</button>
        </form>
    </div>
</body>

</html>