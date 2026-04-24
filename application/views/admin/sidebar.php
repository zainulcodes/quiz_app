<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <a href="#" class="brand-link text-center">
   <span class="brand-text font-weight-light">Molscope Admin</span>
   </a>
   <div class="sidebar">
      <nav>
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
            <li class="nav-header">Master Data</li>
            <li class="nav-item">
               <a href="<?= base_url('admin/index') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="<?= base_url('admin/users') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Users</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="<?= base_url('admin/questions') ?>" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Questions</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="<?= base_url('admin/quiz_questions') ?>" class="nav-link">
                  <i class="nav-icon fas fa-question-circle"></i>
                  <p>Quiz</p>
               </a>
            </li>
            <li class="nav-header">Ranking</li>
            <li class="nav-item">
               <a href="<?= base_url('admin/ranking_questions') ?>" class="nav-link">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>Questions</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="<?= base_url('admin/ranking_quiz') ?>" class="nav-link">
                  <i class="nav-icon fas fa-trophy"></i>
                  <p>Quiz</p>
               </a>
            </li>
            <li class="nav-header">Settings</li>
            <li class="nav-item">
               <a href="<?= base_url('admin/logout') ?>" class="nav-link text-danger">
                  <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                  <p >Logout</p>
               </a>
            </li>
            <!-- <li class="nav-item"><a href="<?= base_url('admin/logout') ?>" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i> <p>Logout</p></li> -->
         </ul>
      </nav>
   </div>
</aside>