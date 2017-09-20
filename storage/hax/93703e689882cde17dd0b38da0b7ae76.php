<?php $this->extend ('layouts.layout'); ?>

<?php $this->section ('page_content'); ?>

<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <section class="col-sm-8">
            <section class="feed-publisher-box">
            
            <form role="form" class="byakuno-form-files" action="<?php echo  route('feeds') ; ?>" method="post" enctype="multipart/form-data">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">
                    <button type="button" class="btn btn-box-tool">
                    <i class="fa fa-edit"></i></button>Ki Ekiriwo?
                </h3>

                
                </div>
                <div class="box-body">
                <div class="input-file-holder"></div>
                        <textarea name="content" class="textarea" placeholder="Baako ne kyoogamba... #hashtags @ebyoogedwa" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="form-group col-xs-12 photo-wrapper" data-group = "A" style="display:none;">
                    <div class="photos-container"> Photos you have choosen</div>
                </div>
                <!-- /.box-body -->
                <input class="photo-upload-input hide" name="photos[]" multiple accept="image/jpeg,image/png" onchange="$byakuno.writeStoryPhotoUpload(this);" type="file">
                <div class="box-footer">
                <button type="button" class="btn btn-box-tool" onclick="javascript:$('.feed-publisher-box').find('input.photo-upload-input').click();">
                    <i class="fa fa-camera"></i>
                </button>
                <button type="button" class="btn btn-box-tool">
                    <i class="fa fa-map-marker"></i>
                </button>
                <button type="submit" class="btn btn-primary pull-right submit-btn">
                    <i class="fa fa-edit progress-icon" data-icon="fa-edit"></i> Tekayo
                </button>
                </div>
                <!-- /.box-footer-->
            </div>
            </form>
            </section>

            <!-- cards go here -->

            <section class="feeds-wrapper">
                                
            </section>
            </section>
            <section class="col-sm-4">
                <section>
                <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('<?php echo  assets('byakunoLogos/wall.png') ; ?>') center center;">
                    <h3 class="widget-user-username"><?php echo  $user->fullname ; ?> </h3>
                    <h5 class="widget-user-desc"><?php echo  ($user->ensibuko)?$user->ensibuko->omuziro:"" ; ?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="<?php echo  $user->avatar() ; ?>" alt="<?php echo  $user->fullname ; ?>">
                </div>
                <div class="box-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </section>
            <section>
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Obubaga Obutereddwaayo <a href="events/new">+ Akapya</a></h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Samsung TV
                            <span class="label label-warning pull-right">$1800</span></a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bicycle
                            <span class="label label-info pull-right">$700</span></a>
                            <span class="product-description">
                                26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                            <span class="product-description">
                                Xbox One Console Bundle with Halo Master Chief Collection.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="/<?=$resource?>css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">PlayStation 4
                            <span class="label label-success pull-right">$399</span></a>
                            <span class="product-description">
                                PlayStation 4 500GB Console (PS4)
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Laba Obubaga Bwonna</a>
                </div>
                <!-- /.box-footer -->
                </div>
            </section>
            <section>
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Bano Obamanyi? <a href="events/new">Yongerawo</a></h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Samsung TV
                            <span class="label label-warning pull-right">$1800</span></a>
                            <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Bicycle
                            <span class="label label-info pull-right">$700</span></a>
                            <span class="product-description">
                                26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                            <span class="product-description">
                                Xbox One Console Bundle with Halo Master Chief Collection.
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                        <img src="/<?=$resource?>css/dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">PlayStation 4
                            <span class="label label-success pull-right">$399</span></a>
                            <span class="product-description">
                                PlayStation 4 500GB Console (PS4)
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Laba Bonna</a>
                </div>
                <!-- /.box-footer -->
                </div>
            </section>
            </section>
        </section>
        <!-- /.content -->
    </div>
<!-- /.container -->
</div>

<div class="modal fade" id="post-image-gallery" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ebifaananyi</h4>
            </div>
            <div class="modal-body" id="modal-content-body" style="margin:0;">
                    
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php $this->endSection() ?>