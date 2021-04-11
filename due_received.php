<?php include 'inc/require_page_content/top.php'; ?>
<body id="page-top">
  <div id="wrapper">
    <?php include 'inc/require_page_content/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include 'inc/require_page_content/header.php'; ?>
        <?php include 'inc/pages/rec_due.php'; ?>
      </div>
      <?php include 'inc/require_page_content/footer.php'; ?>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php //include 'inc/model/logout.php'; ?>
  <?php include 'inc/require_page_content/bottom.php'; ?>