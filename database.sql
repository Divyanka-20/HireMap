CREATE DATABASE hiremap;

USE hiremap;

CREATE TABLE users (
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    phno VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(80) NOT NULL PRIMARY KEY,
    password VARCHAR(20) NOT NULL
);

CREATE TABLE experiences (
    ref_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    rounds TEXT,
    interview_questions TEXT,
    preparation_technique TEXT,
    tips TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE faqs (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

INSERT INTO faqs (question, answer) VALUES
('What is Hire Map?', 'Hire Map is a one-stop platform to prepare for job interviews through real experiences, FAQs, free courses, and job listings.'),
('Do I need to register to use Hire Map?', 'You can view most resources without registration. However, registration is required to share experiences and access personalized features.'),
('How do I share my interview experience?', 'Once you''re logged in, click on "Share Experience" from the sidebar or homepage, fill out the form, and submit it.'),
('Is Hire Map free to use?', 'Yes! All resources and courses listed are free of cost.'),
('What kind of interview experiences can I find here?', 'You can explore experiences from real candidates for various roles in tech, management, and core companies.'),
('How do I prepare for technical interviews?', 'Start with our courses, review past interview experiences, and read through FAQs under "Interview FAQs."'),
('Are these resources suitable for freshers?', 'Yes, Hire Map is built with fresh graduates and early-career professionals in mind.'),
('Where can I find recent job openings?', 'Visit the "Recent Job Listings" section from the sidebar. We regularly update new openings and internships.'),
('Are the courses certified?', 'Many free courses we link to are from reputed platforms like Coursera, edX, and YouTube. Certifications depend on the source.'),
('Can I filter jobs by field or location?', 'We are working on adding advanced filters. Stay tuned!'),
('I forgot my password. What should I do?', ' Click on the "Forgot Password?" link on the login page to reset your password.'),
('How do I contact support?', 'You can use email us at support@hiremap.com.'),
('How often are job listings updated?', 'Our team updates job and internship listings daily to ensure you don’t miss any opportunity.'),
('Can I edit or delete my shared interview experience?', 'Currently, editing can be accessed from "My Experiences" sections and deleting shared experiences is not available. Contact support@hiremap.com for changes.'),
('Do you verify the authenticity of shared interview experiences?', 'We review submissions for appropriateness and clarity but do not independently verify them. Readers are encouraged to use their judgment.'),
('How do I report inappropriate or false content?', 'Email us directly at report@hiremap.com.'),
('Is there a mobile app for Hire Map?', 'Not yet, but we are working on it.'),
('What should I include in my interview experience submission?', 'Mention company, role, interview rounds, questions asked, and your tips or mistakes. The more detailed, the better!'),
('Are non-tech/domain-specific interviews also featured?', 'Yes, Hire Map welcomes interview experiences from all fields: HR, marketing, finance, design, law, etc.'),
('How has Hire Map helped other users?', 'Many users have successfully cracked interviews after using our resources and sharing their journeys with us. You could be next!'),
('Can I get inspired by success stories on Hire Map?', 'Absolutely! Real experiences from successful candidates are a great way to boost your confidence and strategy.'),
('What makes Hire Map different from other platforms?', 'We combine real experiences, FAQs, curated courses, and updated job listings all in one place with no hidden costs.'),
('Is Hire Map suitable for self-paced preparation?', 'Yes! You can explore interviews, FAQs, and courses anytime, at your own pace.'),
('How can Hire Map boost my interview confidence?', 'By reading others journeys, learning from FAQs, and practicing with courses, you will be much more prepared and confident.'),
('Why should I share my experience on Hire Map?', 'Your journey can inspire and guide others just like how others helped you. Plus, it builds your own reflection and confidence.'),
('Can using Hire Map improve my chances of getting hired?', 'While we do not guarantee a job, our platform has empowered many users with better preparation, clarity, and performance in interviews.'),
('Is Hire Map a supportive community?', 'Yes! We encourage knowledge sharing and support through authentic user content and continuous improvement.');

CREATE TABLE recent_jobs (
    job_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    job_type VARCHAR(50),
    experience_level VARCHAR(50),
    salary_range VARCHAR(50),
    posted_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    skills_required TEXT
);


INSERT INTO recent_jobs 
(title, company, location, job_type, experience_level, salary_range, description, skills_required)
VALUES
 ('Frontend Developer', 'TechNova Solutions', 'Bangalore', 'Full-time', '1-2 years', '5-7 LPA', 'Responsible for UI implementation using React.js and TailwindCSS.', 'HTML, CSS, JavaScript, React, TailwindCSS'),
 ('Backend Intern', 'CodeWorks Pvt Ltd', 'Remote', 'Internship', 'Fresher', '10K/month', 'Support backend API development using Node.js.', 'Node.js, Express, MongoDB, REST API'),
 ('Data Analyst', 'Insight Analytics', 'Hyderabad', 'Full-time', '2-4 years', '6-9 LPA', 'Analyze business data and generate visual reports.', 'SQL, Python, Power BI, Excel'),
 ('Python Developer', 'Wipro', 'Chennai, India', 'Full-Time', 'Mid-Level', '6-10 LPA', 'Responsible for developing and maintaining Python applications.', 'Python, Django, REST API, SQL'),
 ('Full Stack Developer', 'HCLTech', 'Remote', 'Full-Time', 'Mid-Level', '8-12 LPA', 'Work on both frontend and backend development of web applications.', 'HTML, CSS, JavaScript, React, Node.js, SQL'),
 ('CyberSecurity', 'Tech Mahindra', 'Kolkata, India', 'Full-Time', 'Entry-Level', '5-8 LPA', 'Monitor and secure company systems against cyber threats.', 'Network Security, Penetration Testing, Firewalls, Linux');


CREATE TABLE interview_courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    level VARCHAR(50),
    duration VARCHAR(50),
    link TEXT
);


INSERT INTO interview_courses (title, description, level, duration, link) VALUES
('Mastering Behavioral Interviews', 'Learn strategies to tackle common behavioral interview questions.', 'Beginner', '4 hours', 'https://www.coursera.org/projects/preparation-for-job-interviews'),
('Technical Interview Prep: Data Structures', 'Deep dive into essential data structures for coding interviews.', 'Intermediate', '48 hours', 'https://www.coursera.org/learn/msft-data-structures-and-algorithms'),
('Resume & Portfolio Building', 'Learn how to create a professional resume and portfolio that stands out to recruiters.', 'Beginner', '2.5 hours', 'https://www.mygreatlearning.com/academy/learn-for-free/courses/resume-building'),
('Behavioral Interview Mastery', 'Master the art of answering HR and behavioral interview questions with confidence.', 'All Levels', '3 hours', 'https://www.freecodecamp.org/news/mastering-behavioral-interviews-for-software-developers/'),
('Job Search Strategies & Networking', 'Discover effective job hunting techniques and networking skills to land your dream job.', 'Beginner to Intermediate', '2 hours', 'https://edu.gcfglobal.org/en/jobsearchandnetworking/networking-basics/1/'),
('Ace the HR Round', 'Tips and tricks to impress HR and show cultural fit.', 'All Levels', '1.5 hours', 'https://www.simplilearn.com/hr-interview-questions-answers-article');


CREATE TABLE interview_faqs (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    category VARCHAR(100),
    company VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO interview_faqs (question, answer, category, company)
VALUES 
('Tell me about yourself.', 'Start with your name, education, key projects or work experience, and end with why you’re a good fit for the role.', 'HR', 'General'),

('What are your strengths and weaknesses?', 'Strengths should align with the job role; for weaknesses, mention a real one and how you’re improving on it.', 'HR', 'General'),

('Explain the difference between GET and POST methods in HTTP.', 'GET sends data via URL and is visible, while POST sends data in the request body and is more secure for sensitive data.', 'Technical', 'General');


INSERT INTO experiences (
    user_id, job_title, company, updated_at, rounds, interview_questions, preparation_technique, tips
) VALUES
(
    1,
    'System Engineer',
    'Infosys',
    '2025-07-08 14:37:11',
    '1. Aptitude + Technical MCQ\n2. Technical Interview\n3. HR Interview',
    '- Write a program to reverse a linked list.\n- What is normalization in DBMS?\n- Describe your final year project.\n- Why do you want to join Infosys?',
    '- Practiced DSA regularly on GeeksforGeeks.\n- Revised core subjects (DBMS, OS, CN, OOP) from college notes.',
    '- Be confident in your fundamentals.\n- Practice mock interviews with friends or peers.\n- Read up on company profile and recent developments before the HR round.'
),
(
    1,
    'Software Developer',
    'TCS',
    '2025-07-08 15:13:42',
    '1. Online Assessment\n2. Technical Interview\n3. Managerial + HR Round',
    '- Explain OOPs concepts with examples.\n- Write SQL query to find second highest salary.\n- What is multithreading in Java?\n- Why should we hire you?',
    '- Solved LeetCode and GFG problems daily.\n- Focused on Java and DBMS concepts.\n- Mock interviews with seniors.',
    '- Don’t bluff—be honest if you don’t know.\n- Revise your resume before the interview.\n- Have a few smart questions ready for the interviewer.'
);

