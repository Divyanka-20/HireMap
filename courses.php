<?php include 'database_connection.php'; ?>
<?php
// Fetch courses from the database
$courses = [];
$sql = "SELECT title, description, level, duration, link FROM interview_courses ORDER BY course_id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hire Map | Interview Courses</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
      font-family: Arial, sans-serif;
      background: url("https://www.elegantthemes.com/blog/wp-content/uploads/2013/09/bg-11-full.jpg");
      margin: 0;
      padding: 0;
      text-align: center;
    }
        h1 {
      text-align: center !important;
      color: crimson;
      font-family: 'Times New Roman', Times, serif;
      font-weight: bold;
      font-size: 35px;
    }
        .container {
      max-width: 900px;
      margin: 50px 210px 20px;
      padding: 20px;
      flex: 1;
    }
        .course-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .course-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            display: flex;
            width: 300px;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s;
        }
        .course-card:hover {
            transform: translateY(-5px);
        }
        .course-title {
            font-size: 18px;
            font-weight: bold;
            color: #006d3c;
            margin-bottom: 10px;
        }
        .course-desc {
            font-size: 14px;
            margin-bottom: 15px;
        }
        .course-meta {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }
        .course-link {
            margin-top: auto; /* pushes it to the bottom */
            align-self: center; /* optional: aligns to left */
            padding: 10px 35px;
            background: linear-gradient(to right, #f7941d, #ed1c4f);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .course-link:hover {
            background: linear-gradient(to right, #ed1c4f, #f7941d);
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

    <br><br><br><br><br><h1>INTERVIEW COURSES</h1>

<div class=container>
    <div class="course-grid">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <div class="course-title"><?php echo htmlspecialchars($course['title']); ?></div>
                    <div class="course-desc"><?php echo htmlspecialchars($course['description']); ?></div>
                    <div class="course-meta">
                        Level: <?php echo htmlspecialchars($course['level']); ?><br>
                        Duration: <?php echo htmlspecialchars($course['duration']); ?>
                    </div>
                    <a href="<?php echo htmlspecialchars($course['link']); ?>" class="course-link" target="_blank">View Course</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No courses available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>