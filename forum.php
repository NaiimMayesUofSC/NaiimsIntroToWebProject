<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Football Fan Zone - Forum</title>
  <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
  <style>
    /* Internal CSS for Forum */
    .forum-box {
      background: #eee;
      padding: 20px;
      margin: 15px;
      border-radius: 8px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }
    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <!-- Header & Navbar -->
  <header>
    <h1>Football Fan Zone <span style="color:brown;">★</span></h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="teams.html">Teams</a>
      <a href="players.html">Players</a>
      <a href="news.html">News</a>
      <a href="forum.html" class="active">Forum</a>
    </nav>
  </header>

 
<!-- inside forum.php where your form is -->
<section class="forum-box">
  <h3>Create New Post</h3>

  <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="success">Share your thoughts</div>
  <?php endif; ?>

  <form action="submit_post.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Enter your username" required>

    <label for="title">Post Title</label>
    <input type="text" id="title" name="title" placeholder="Enter post title" required>

    <label for="category">Category</label>
    <select id="category" name="category" required>
      <option value="">Select Category</option>
      <option value="Game Recaps">Game Recaps</option>
      <option value="Analysis">Analysis</option>
      <option value="Injuries">Injuries</option>
      <option value="Other">Other</option>
    </select>

    <label for="message">Message</label>
    <textarea id="message" name="message" rows="6" placeholder="Share your thoughts..." required></textarea>

    <button class="btn blue" type="submit">Submit</button>
  </form>
</section>



<!-- ===== Footer ===== -->
<footer>
  <p>&copy; 2025 Football Fan Zone. All Rights Reserved.</p>
  <div class="footer-links">
    <a href="#">Privacy Policy</a> | 
    <a href="#">Terms of Use</a> | 
    <a href="#">Contact</a>
  </div>
</footer>
</html>

