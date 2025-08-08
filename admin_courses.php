<?php
// Handle form submission
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connection.php';

    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        // Get form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $level = $_POST['level'];
        $duration = $_POST['duration'];
        $link = $_POST['link'];

        // Insert query
        $stmt = $conn->prepare("INSERT INTO interview_courses (title, description, level, duration, link) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $level, $duration, $link);

        if ($stmt->execute()) {
            $success = "✅ Course added successfully!";
        } else {
            $error = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Interview Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
        }
        form {
            background-color: white;
            padding: 25px;
            max-width: 600px;
            margin: auto;
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            max-width: 600px;
            margin: 10px auto;
            text-align: center;
            padding: 10px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <h2>Add New Interview Course</h2>

    <?php if ($success): ?>
        <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Course Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" rows="4" placeholder="Brief overview of the course..." required></textarea>

        <label>Level:</label>
        <input type="text" name="level" placeholder="e.g. Beginner, Intermediate" required>

        <label>Duration:</label>
        <input type="text" name="duration" placeholder="e.g. 4 weeks, 10 hours" required>

        <label>Course Link:</label>
        <input type="text" name="link" placeholder="e.g. https://example.com/course" required>

        <button type="submit">Add Course</button>
    </form>

</body>
</html>