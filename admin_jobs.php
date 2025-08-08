<?php
// Handle form submission
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // DB connection
    include 'database_connection.php';

    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        // Get form data
        $title = $_POST['title'];
        $company = $_POST['company'];
        $location = $_POST['location'];
        $job_type = $_POST['job_type'];
        $experience_level = $_POST['experience_level'];
        $salary_range = $_POST['salary_range'];
        $description = $_POST['description'];
        $skills_required = $_POST['skills_required'];

        // Insert query
        $stmt = $conn->prepare("INSERT INTO recent_jobs (title, company, location, job_type, experience_level, salary_range, description, skills_required) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $title, $company, $location, $job_type, $experience_level, $salary_range, $description, $skills_required);

        if ($stmt->execute()) {
            $success = "✅ Job added successfully!";
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
    <title>Admin - Add Job</title>
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
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 12px 20px;
            background-color: #2e86de;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #1b4f72;
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

    <h2>Add New Job Listing</h2>

    <?php if ($success): ?>
        <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Job Title:</label>
        <input type="text" name="title" required>

        <label>Company:</label>
        <input type="text" name="company" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Job Type:</label>
        <select name="job_type">
            <option value="Full-time">Full-time</option>
            <option value="Internship">Internship</option>
            <option value="Part-time">Part-time</option>
            <option value="Remote">Remote</option>
        </select>

        <label>Experience Level:</label>
        <input type="text" name="experience_level" placeholder="e.g. Fresher, 1-3 years">

        <label>Salary Range:</label>
        <input type="text" name="salary_range" placeholder="e.g. 5-8 LPA">

        <label>Job Description:</label>
        <textarea name="description" rows="4" placeholder="Enter job responsibilities..."></textarea>

        <label>Skills Required:</label>
        <textarea name="skills_required" rows="3" placeholder="e.g. HTML, CSS, JavaScript"></textarea>

        <button type="submit">Add Job</button>
    </form>

</body>
</html>
