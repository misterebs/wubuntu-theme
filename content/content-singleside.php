<aside class="col-sm-3">
  <div class="widget sticky-scroll-box">
    <?php if(is_active_sidebar('fixed')): ?>
      <?php dynamic_sidebar('fixed'); ?>
    <?php endif; ?>
  </div>
  <div class="widget sidebar-module">
    <?php if(is_active_sidebar('sidesingle')): ?>
      <?php dynamic_sidebar('sidesingle'); ?>
    <?php endif; ?>
  </div>
</aside><!-- /.blog-sidebar -->

</div><!-- /.row -->

</div><!-- /.container -->
