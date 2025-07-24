<?php
$apiKey = 'd479ed507e584b1998e02eeaf1bbe08b';
$url = "https://newsapi.org/v2/top-headlines?category=technology&country=us&pageSize=3&apiKey=$apiKey";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'TechNewsToday');

$response = curl_exec($ch);

if ($response === false) {
    echo "cURL error: " . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

$data = json_decode($response, true);

// if ($response === false) {
//     echo "cURL error: " . curl_error($ch);
// } else {
//     echo "<pre>";
//     var_dump($response);
//     echo "</pre>";
// }

$articles = $data['articles'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Latest Tech News</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="text-center py-3 bg-light border-bottom">
  <img src="logo.png" alt="Tech News Today Logo" class="img-fluid" style="max-height: 80px;">
</header>

<div class="news-header">
  <h1>News Portal</h1>
  <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
  </p>
</div>

<div class="card-container">
  <div class="container">
    <div class="row justify-content-center">
      <?php foreach ($articles as $article): ?>
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
          <div class="card card-custom shadow-sm border-0 rounded-4 w-100" onclick="window.open('<?php echo $article['url']; ?>', '_blank')">
            <img src="<?php echo $article['urlToImage'] ?? 'https://via.placeholder.com/400x200'; ?>" class="card-img-top rounded-top-4" alt="News Image">
            <div class="card-body">
              <h5 class="card-title fw-bold"><?php echo $article['title']; ?></h5>
              <p class="card-text text-muted">
                <?php echo substr($article['description'], 0, 120); ?>...
              </p>
              <p class="text-muted small mb-0"><strong>Source:</strong> <?php echo $article['source']['name']; ?></p>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<footer class="about-footer text-white text-center py-5">
  <div class="container">
    <h5 class="fw-bold mb-3">About This Site</h5>
    <p class="mb-0">
      Powered by the <strong>NewsAPI</strong>
    </p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

