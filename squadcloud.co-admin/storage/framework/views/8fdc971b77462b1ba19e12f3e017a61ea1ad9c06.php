<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 
 <?php $__env->startSection('title','Dashboard'); ?>
 <?php $__env->startSection('content'); ?>
 <style>
  .custom-card-height {
    height: 280px;
    overflow-y: auto;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><span><i class="fas fa-chart-pie"></i></span> Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?php echo e(route('contact.index')); ?>" class="small-box-footer">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo e($contactRequest); ?></h3>
                <p>Contact Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?php echo e(route('cities.index')); ?>" class="small-box-footer">
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo e($cities); ?></h3>
                <p>Cities</p>
              </div>
              <div class="icon">
                <i class="ion ion-location"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?php echo e(route('front-faqs.index')); ?>" class="small-box-footer">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo e($faqs); ?></h3>
                <p>Faqs</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="<?php echo e(route('coveragerequest.index')); ?>">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo e($requestCount); ?></h3>
                <p>Covrage Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-navigate"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <a href="<?php echo e(route('reseller.index')); ?>" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo e($resellers); ?></h3>
                <p>
                  Resellers & Partners
                </p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="<?php echo e(route('packages.index')); ?>" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?php echo e($package); ?></h3>
                <p>
                  Internet Packages
                </p>
              </div>
              <div class="icon">
                <i class="ion ion-wifi"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="<?php echo e(route('social.index')); ?>" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo e($social); ?></h3>
                <p>
                  Socials Midea
                </p>
              </div>
              <div class="icon">
                <i class="ion ion-planet"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="<?php echo e(route('user.index')); ?>" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3><?php echo e($user); ?></h3>
                <p>
                  Site Managment Users
                </p>
              </div>
              <div class="icon">
                <i class="ion ion-settings"></i>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-phone mr-1"></i>
                Today's Contact Requests
              </h3>
            </div>
            <div class="card-body custom-card-height">
              <table class="table table-bordered table-striped" style="cursor:pointer">
                <thead>
                  <tr>
                    <th>Serial#</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Date & time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $frontContact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr onclick="openInNewTab('contact');">
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->email); ?></td>
                    <td><?php echo e($item->phone); ?></td>
                    <td><?php echo e($item->message); ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa-solid fa-bell"></i>
                Today's Requests
              </h3>
            </div>
            <div class="card-body custom-card-height">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <li class="nav-item">
                      <a class="nav-link active" id="v-pills-reseller-tab" data-toggle="pill" href="#revenue-chart" role="tab" aria-controls="v-pills-reseller" aria-selected="true"><i class="fa-solid fa-handshake"></i> Reseller & Partner Requests</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="v-pills-consumer-tab" data-toggle="pill" href="#sales-chart" role="tab" aria-controls="v-pills-consumer" aria-selected="false"><i class="fa-solid fa-users"></i> Consumer's Requests</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="tab-content" id="v-pills-tabContent">
                    <!-- Reseller's Requests -->
                    <div class="tab-pane fade show active" id="revenue-chart" role="tabpanel" aria-labelledby="v-pills-reseller-tab">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="cursor:pointer">
                          <!-- Table content for Reseller's Requests -->
                          <thead>
                            <tr>
                              <th>Serial#</th>
                              <th>Name</th>
                              <th>Email Address</th>
                              <th>Contact Number</th>
                              <th>Address</th>
                              <th>Date & time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $coverageMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr onclick="openInNewTab('coveragerequest');">
                              <td><?php echo e(++$key); ?></td>
                              <td><?php echo e($item->name); ?></td>
                              <td><?php echo e($item->email); ?></td>
                              <td><?php echo e($item->mobile_no); ?></td>
                              <td><?php echo e($item->address); ?></td>
                              <td><?php echo e($item->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Consumer's Requests -->
                    <div class="tab-pane fade" id="sales-chart" role="tabpanel" aria-labelledby="v-pills-consumer-tab">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="cursor:pointer">
                          <!-- Table content for Consumer's Requests -->
                          <thead>
                            <tr>
                              <th>Serial#</th>
                              <th>Name</th>
                              <th>Email Address</th>
                              <th>Contact Number</th>
                              <th>Address</th>
                              <th>Date & time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $coverageUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr onclick="openInNewTab('coveragerequest');">
                              <td><?php echo e($key++); ?></td>
                              <td><?php echo e($item->name); ?></td>
                              <td><?php echo e($item->email); ?></td>
                              <td><?php echo e($item->mobile_no); ?></td>
                              <td><?php echo e($item->address); ?></td>
                              <td><?php echo e($item->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<!-- Code Finalize -->
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/home/dashboard.blade.php ENDPATH**/ ?>