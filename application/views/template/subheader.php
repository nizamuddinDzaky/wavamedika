<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
$uri4 = $this->uri->segment(4);
?>

<div class="kt-subheader kt-grid__item" id="kt_subheader">
  <div class="kt-container ">
    <div class="kt-subheader__main">
      <h3 class="kt-subheader__title">
        <?= $title ?>
      </h3>
      <div class="kt-subheader__breadcrumbs">
        <a href="<?= site_url('dashboard') ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="<?= site_url() . $uri1 . "/" ?>" class="kt-subheader__breadcrumbs-link">
          <?= ucfirst($uri1) ?> </a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="<?= site_url() . "tpp/" . $uri2 ?>" class="kt-subheader__breadcrumbs-link">
          <?= ucfirst($uri2) ?> </a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="<?= site_url() . "tpp/" . $uri2 . "/" . $uri3 ?>" class="kt-subheader__breadcrumbs-link">
          <?= $title ?>
        </a>
      </div>
    </div>
    <div class="kt-subheader__toolbar">
      <div class="kt-subheader__wrapper">
        <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
          Export PDF
        </a>
        <a id="print" class="btn kt-subheader__btn-secondary">
          Print
        </a>
      </div>
    </div>
  </div>
</div>