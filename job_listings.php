<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hire Map | Recent Job Listings</title>
<link rel="shortcut icon" href="assets/logo.png" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="shortcut icon" href="assets/logo.png" type="image/png">
<style>
    body {
      font-family: Arial, sans-serif;
      background: url("https://www.elegantthemes.com/blog/wp-content/uploads/2013/09/bg-11-full.jpg");
      margin: 0;
      padding: 0;
      text-align: center;
    }

    h1 {
        margin-top: 90px;
        text-align: center;
        color: black;
        font-weight: bolder;
        margin-bottom: 20px;
    }

    .job-listings {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); /* responsive columns */
        gap: 20px;
        margin: 0 auto 50px auto;
        padding: 20px;
        width: 90%;
        max-width: 1200px;
        box-sizing: border-box;
    }

    .job-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s;
        display: flex;
        flex-direction: column;
        height: auto; /* Let card height adjust based on content */
        box-sizing: border-box;
        overflow: hidden;
    }

    .job-card:hover {
        transform: scale(1.02);
    }

    .job-title {
        font-size: 1.5rem;
        font-weight: bolder;
        color: black;
        margin-bottom: 8px;
    }

    .company, .location, .job-type, .experience, .salary, .posted-date, .description, .skills {
        color: #555;
        font-size: 1rem;
        margin-bottom: 6px;
        text-align: left;
    }

    .apply-btn {
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

    .apply-btn:hover {
        background: linear-gradient(to right, #ed1c4f, #f7941d);
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    h1 {
      text-align: center;
      color: crimson;
      font-family: 'Times New Roman', Times, serif;
      font-weight: bold;
      font-size: 35px;
    }

    .dropdown-toggle::after {
        display: inline-block !important;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-left: .3em solid transparent;
    }
</style>
</head>
<body>
<div class="wrapper">
<?php include 'navbar.php'; ?>
<?php include 'database_connection.php'; ?>

<br><h1>RECENT JOB LISTINGS</h1><br>

<div class="job-listings">
<?php
$sql = "SELECT job_id, title, company, location, job_type, experience_level, salary_range, posted_date, description, skills_required 
        FROM recent_jobs 
        ORDER BY posted_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($job = $result->fetch_assoc()) {
        echo '<div class="job-card">';
        echo '<div class="job-title">' . htmlspecialchars($job['title']) . '</div>'.'<br>';
        echo '<div class="company"><strong>Company:</strong> ' . htmlspecialchars($job['company']) . '</div>';
        echo '<div class="location"><strong>Location:</strong> ' . htmlspecialchars($job['location']) . '</div>';
        echo '<div class="job-type"><strong>Type:</strong> ' . htmlspecialchars($job['job_type']) . '</div>';
        echo '<div class="experience"><strong>Experience:</strong> ' . htmlspecialchars($job['experience_level']) . '</div>';
        echo '<div class="salary"><strong>Salary:</strong> ' . htmlspecialchars($job['salary_range']) . '</div>';
        echo '<div class="description"><strong>Description:</strong> ' . nl2br(htmlspecialchars($job['description'])) . '</div>';
        echo '<div class="skills"><strong>Skills:</strong> ' . nl2br(htmlspecialchars($job['skills_required'])) . '</div>';
        echo '<div class="posted-date"><strong>Posted:</strong> ' . date("M d, Y", strtotime($job['posted_date'])) . '</div>';
        echo '<div class="apply-btn">Apply Now</div>';
        echo '</div>';
    }
} else {
    echo "<p style='text-align:center;'>No job listings available at the moment.</p>";
}
$conn->close();
?>
</div>

<?php include 'footer.php'; ?>
</div>
</body>
</html>