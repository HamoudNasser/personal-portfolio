
<?php


/* CSRF */ 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



$remaining_seconds = 0;

if (isset($_SESSION['last_message_time'])) {
    $elapsed = time() - $_SESSION['last_message_time'];
    $remaining_seconds = max(0, 60 - $elapsed);
}




if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}




/* Dynamic Years of Learning */

$start_year = 2022;

$current_year = (int) (new DateTime(
    "now",
    new DateTimeZone("Asia/Riyadh")
))->format("Y");

$years_learning = max(0, $current_year - $start_year);










include "db_connect.php";




$sql = "SELECT * FROM info";

$result = $conn->query($sql);

$row = $result->fetch_assoc();





$skills_sql = "SELECT * FROM skills ORDER BY category";

$skills_result = $conn->query($skills_sql);


$skills_by_category = [];

$skills_count = 0;

while ($skill = $skills_result->fetch_assoc()) {

    $category = $skill['category'];

    $skills_by_category[$category][] = $skill['skill_name'];

    $skills_count++;
}




$projects_sql = "SELECT * FROM projects";

$projects_result = $conn->query($projects_sql);

$projects_count = $projects_result->num_rows;





$certificates_sql = "SELECT * FROM certificates ORDER BY issue_date DESC, id DESC";
$certificates_result = $conn->query($certificates_sql);





?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamoud Almajhdi | Portfolio</title>
    <link rel="stylesheet" href="style.css?v=3">

</head>

<body>



<header class="navbar">
    <div class="nav-container">

        <a href="#home" class="logo">
            <span>&lt;/&gt;</span> Hamoud Almajhdi
        </a>



<button
    class="menu-toggle"
    type="button"
    aria-label="Open navigation menu"
    aria-expanded="false"
    aria-controls="mobile-navigation">
    <span></span>
    <span></span>
    <span></span>
</button>



        <nav class="nav-links" id="mobile-navigation">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#certificates">Certificates</a>
            <a href="#contact">Contact</a>

        </nav>

        <a href="#contact" class="resume-btn">Contact Me</a>

    </div>
</header>




    
<section id="home" class="hero">

    <div class="hero-container"> 

        <div class="hero-content">

            <p class="hero-label">Hello, I'm</p>

            <h1>
                <?php echo htmlspecialchars($row['name']); ?>
            </h1>

            <h3>
                <?php echo htmlspecialchars($row['major']); ?> Student
            </h3>

            <p class="hero-description">
                Building scalable, secure, and practical
                software solutions.
            </p>

            <div class="hero-buttons">
                <a href="#projects" class="btn-primary">
                    View My Projects
                </a>

                <a href="#contact" class="btn-secondary">
                    Contact Me
                </a>
            </div>

        </div>

        <div class="hero-visual">
            <div class="code-symbol">&lt;/&gt;</div>
        </div>

    </div>

    <div class="stats-container">

        <div class="stat">
            <h3>Software Engineering</h3>
            <p>Student</p>
        </div>

        <div class="stat">
            <h3><?php echo $projects_count;?></h3>
            <p>Featured Projects</p>
        </div>

        <div class="stat">
            <h3><?php echo $skills_count; ?></h3>
            <p>Technical & Professional Skills</p>
        </div>

        <div class="stat">
            <h3><?php echo $years_learning;?>+</h3>
            <p>Years of Learning</p>
        </div>

    </div>

</section>








<section id="about" class="about-section">

    <div class="section-heading">
        <p>About Me</p>
        <h2>A Little About Me</h2>
    </div>

    <div class="about-container">

        <div class="about-card">
            <div class="about-image">
                &lt;/&gt;
            </div>
        </div>

        <div class="about-text">

            <p>
                <?php echo htmlspecialchars($row['about_me']); ?>
            </p>

            <div class="about-features">

                <div class="feature-box">
                    <h3>Build</h3>
                    <p>Practical Solutions</p>
                </div>

                <div class="feature-box">
                    <h3>Work in</h3>
                    <p>Collaborative Teams</p>
                </div>

                <div class="feature-box">
                    <h3>Continuously</h3>
                    <p>Learn & Improve</p>
                </div>

            </div>

        </div>

    </div>

</section>









<section id="skills" class="skills-section">

    <div class="section-heading">
        <p>My Skills</p>
        <h2>Skills & Expertise</h2>
    </div>

    <div class="skills-grid">

        <div class="skill-card">
            <h3>Software Development</h3>
            <ul>
                <?php
                if (isset($skills_by_category['Software Development'])) {
                    foreach ($skills_by_category['Software Development'] as $skill_name) {
                        echo "<li>" . htmlspecialchars($skill_name) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="skill-card">
            <h3>AI & Machine Learning</h3>
            <ul>
                <?php
                if (isset($skills_by_category['AI & Machine Learning'])) {
                    foreach ($skills_by_category['AI & Machine Learning'] as $skill_name) {
                        echo "<li>" . htmlspecialchars($skill_name) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="skill-card">
            <h3>Cybersecurity & Networks</h3>
            <ul>
                <?php
                if (isset($skills_by_category['Cybersecurity & Networks'])) {
                    foreach ($skills_by_category['Cybersecurity & Networks'] as $skill_name) {
                        echo "<li>" . htmlspecialchars($skill_name) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="skill-card">
            <h3>Leadership & Soft Skills</h3>
            <ul>
                <?php
                if (isset($skills_by_category['Leadership & Soft Skills'])) {
                    foreach ($skills_by_category['Leadership & Soft Skills'] as $skill_name) {
                        echo "<li>" . htmlspecialchars($skill_name) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

    </div>

</section>







<section id="projects" class="projects-section">

    <div class="section-heading">
        <p>Featured Projects</p>
        <h2>My Projects</h2>
    </div>

    <div class="projects-grid">

        <?php while ($project = $projects_result->fetch_assoc()) { ?>

            <article class="project-card">

                <div class="project-image">

                    <?php if (!empty($project['image'])) { ?>

                        <img
                            src="<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8'); ?>"
                        >

                    <?php } else { ?>

                        <span>&lt;/&gt;</span>

                    <?php } ?>

                </div>

                <div class="project-content">

                    <h3>
                        <?php echo htmlspecialchars($project['project_name']); ?>
                    </h3>

                    <p>
                        <?php echo htmlspecialchars($project['description']); ?>
                    </p>

                    <div class="project-technologies">
                        <?php echo htmlspecialchars($project['technologies']); ?>
                    </div>

                    <?php if (!empty($project['project_link'])) { ?>

                        <a
                            href="<?php echo htmlspecialchars($project['project_link'], ENT_QUOTES, 'UTF-8'); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-link"
                        >
                            View Project →
                        </a>

                    <?php } ?>

                </div>

            </article>

        <?php } ?>

    </div>

</section>

















<section id="certificates" class="certificates-section">

    <div class="section-heading">
        <p>My Achievements</p>
        <h2>Certificates & Achievements</h2>
    </div>

    <div class="certificates-grid">

        <?php while ($certificate = $certificates_result->fetch_assoc()) { ?>

            <article class="certificate-card">

                
            
        <a href="<?php echo htmlspecialchars($certificate['image'], ENT_QUOTES, 'UTF-8'); ?>"
        class="certificate-image"
        data-certificate-title="<?php echo htmlspecialchars($certificate['title'], ENT_QUOTES, 'UTF-8'); ?>">


                    <img
                        src="<?php echo htmlspecialchars($certificate['image'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?php echo htmlspecialchars($certificate['title'], ENT_QUOTES, 'UTF-8'); ?>"
                        loading="lazy"
                    >

                </a>

                <div class="certificate-content">

                    <span class="certificate-category">
                        <?php echo htmlspecialchars($certificate['category']); ?>
                    </span>

                    <h3>
                        <?php echo htmlspecialchars($certificate['title']); ?>
                    </h3>

                    <p class="certificate-issuer">
                        <?php echo htmlspecialchars($certificate['issuer']); ?>
                    </p>

                    <?php if (!empty($certificate['issue_date'])) { ?>
                        <p class="certificate-date">
                            <?php echo date('F Y', strtotime($certificate['issue_date'])); ?>
                        </p>
                    <?php } ?>

                </div>

            </article>

        <?php } ?>

    </div>

</section>















<section id="contact" class="contact-section">

    <div class="section-heading">
        <p>Get In Touch</p>
        <h2>Contact Me</h2>
    </div>







<?php if (($_GET['contact'] ?? '') === 'success') { ?>

    <p class="success-message" role="status">
        Your message has been sent successfully.
    </p>

<?php } ?>





<div id="countdown-box"
     data-remaining="<?php echo $remaining_seconds; ?>"
     hidden>
    <span id="countdown"><?php echo $remaining_seconds; ?></span>
</div>








    <div class="contact-container">

        <div class="contact-info">

            <h3>Let's Work Together</h3>

            <p>
                I'm open to discussing job opportunities,
                collaborations, and interesting software
                projects. Feel free to reach out!
            </p>

            <div class="contact-details">

                <a href="mailto:h.n.Almajhdi@gmail.com">
                    Email Me
                </a>

                <a href="https://www.linkedin.com/in/hamoud-almajhdi-322177350/"
                   target="_blank"
                   rel="noopener noreferrer">
                    LinkedIn
                </a>

                <a href="https://github.com/HamoudNasser"
                   target="_blank"
                   rel="noopener noreferrer">
                    GitHub
                </a>

            </div>

        </div>

        <form class="contact-form"
              action="contact.php"
              method="POST">





<input type="hidden"
       name="csrf_token"
       value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">



          <!-- Honeypot Protection -->

<div class="hp-field" aria-hidden="true">
    <label for="contact_fax">Fax Number</label>
    <input
        type="text"
        id="contact_fax"
        name="contact_fax"
        autocomplete="off"
        tabindex="-1"
        value="">
</div>








            <div class="form-row">

                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           placeholder="Enter your name"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           placeholder="Enter your email"
                           required>
                </div>

            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text"
                       id="subject"
                       name="subject"
                       placeholder="Project, Opportunity, Collaboration"
                       required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message"
                          name="message"
                          rows="5"
                          placeholder="Write your message..."
                          required></textarea>
            </div>

            <button type="submit" class="send-btn" >
                Send Message
            </button>

        </form>

    </div>

</section>













<div id="certificate-lightbox" class="lightbox" role="dialog"
     aria-modal="true" aria-label="Certificate preview" hidden>

    <button class="lightbox-close"
            type="button"
            aria-label="Close certificate preview">
        &times;
    </button>

    <img id="lightbox-image" src="" alt="">
    <p id="lightbox-title"></p>


</div>

<script src="script.js"></script>






</body>
</html>
