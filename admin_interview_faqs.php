<?php
include 'database_connection.php';

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_faq'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $company = $_POST['company'];

    $stmt = $conn->prepare("INSERT INTO interview_faqs (question, answer, company) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $question, $answer, $company);

    if ($stmt->execute()) {
        $success = "✅ FAQ added successfully!";
    } else {
        $error = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM interview_faqs WHERE id = $id");
    header("Location: admin_interview_faqs.php");
    exit;
}

// Fetch existing FAQs
$faqs = [];
$result = $conn->query("SELECT id, question, answer, company FROM interview_faqs ORDER BY id DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faqs[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin – Interview FAQs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #b22222;
        }
        .form-section, .table-section {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 12px 20px;
            background-color: #006d3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004f2c;
        }
        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .delete-btn {
            background-color: #d9534f;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<h2>Admin – Interview FAQs</h2>

<?php if ($success): ?>
    <div class="message success"><?php echo $success; ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="message error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-section">
    <h3>Add New FAQ</h3>
    <form method="POST">
        <label>Question:</label>
        <textarea name="question" rows="2" required></textarea>

        <label>Answer:</label>
        <textarea name="answer" rows="3" required></textarea>

        <label>Company:</label>
        <input type="text" name="company" required>

        <button type="submit" name="add_faq">Add FAQ</button>
    </form>
</div>

<div class="table-section">
    <h3>Existing FAQs</h3>
    <table>
        <tr>
            <th>Question</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($faqs)): ?>
            <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td><?php echo htmlspecialchars($faq['question']); ?></td>
                    <td><?php echo htmlspecialchars($faq['company']); ?></td>
                    <td>
                        <a href="?delete=<?php echo $faq['id']; ?>" class="delete-btn">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No FAQs found.</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>