<aside class="col-sm-3">
  <div class="widget sidebar-module-inset">
    <?php if(is_active_sidebar('about')): ?>
      <?php dynamic_sidebar('about'); ?>
    <?php endif; ?>
  </div>
  <div class="widget sidebar-module">
    <?php if(is_active_sidebar('sidebar')): ?>
      <?php dynamic_sidebar('sidebar'); ?>
    <?php endif; ?>
  </div>
</aside><!-- /.blog-sidebar -->
</div><!-- /.row -->
</div><!-- /.container -->
