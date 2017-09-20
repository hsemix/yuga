<?php $this->extend ('layouts.layout'); ?>

<?php $this->section ('page_content'); ?>
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content">
          <section class="col-sm-8">
            <?php if($step == 1): ?>
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title col-sm-9">Omutendera Ogusooka</h3>
              <h4 class="box-title col-sm-3">Gyobera?</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo  route('user.register.step', ['step' => Auth::user()->status]) ; ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group<?php echo  $errors->has('ekibuga')?' has-error':'' ; ?>">
                  <label for="diini">Eddiini yo</label>
                  <input class="form-control" id="diini" name="ediini" placeholder="Eddiini yo" type="text" value="<?php echo  $request->old('ediini')?:'' ; ?>">
                  <?php if($errors->has('ediini')): ?>
                    <span class="help-block"><?php echo  $errors->first('ediini') ; ?></span>
                  <?php endif; ?>
                </div>
                <div class="form-group<?php echo  $errors->has('ekibuga')?' has-error':'' ; ?>">
                  <label for="ekibuga">Ekyalo / Ekibuga</label>
                  <input class="form-control" id="ekibuga" name="ekibuga" placeholder="Ekyalo / Ekibuga" type="text" value="<?php echo  $request->old('ekibuga')?:'' ; ?>">
                  <?php if($errors->has('ekibuga')): ?>
                    <span class="help-block"><?php echo  $errors->first('ekibuga') ; ?></span>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="profile-pic">Ekifaananyi</label>
                  <input id="profile-pic" name="profile-pic" type="file" />
                  <p class="help-block">Profile Picture</p>
                </div>
                
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="save">Awaddako</button>
                <button type="submit" class="btn btn-success" name="skip">Buukawo</button>
              </div>
            </form>
          </div>

          <?php elseif($step == 2): ?>
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title col-sm-9">Omutendera Ogwokubiri</h3>
              <h4 class="box-title col-sm-3">Ensibuko yo?</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form role="form" method="post" action="<?php echo  route('user.register.step', ['step' => Auth::user()->status]) ; ?>">
             <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
              <div class="box-body">
                <div class="form-group<?php echo  $errors->has('region')?' has-error':'' ; ?>">
                  <label for="js_regions">Region yo</label>
                  <select class="form-control" name="region" onchange="$byakunoCore.Region.saza(this);">
                    <option value="" title="Region">Londa region yo</option>
                    <?php foreach($regions as $region => $masaza): ?>
                      <option value="<?php echo  $region ; ?>"><?php echo  $region ; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if($errors->has('region')): ?>
                  <span class="help-block"><?php echo  $errors->first('region') ; ?></span>
                <?php endif; ?>
                </div>
                <div class="form-group regions hidden">
                  <label class="float-left span15">Essaza Lyo:</label>
                  <select class="form-control" name="essaza" id="js-saza" onchange="$byakunoCore.Region.gombolola(this);">
                      <option value="">Londa Essaza Lyo</option>
                  </select>
                </div>
                <div class="form-group gombolola hidden">
                  <label class="float-left span15">Eggombolola Lyo:</label>
                  <select name="gombolola" class="form-control" id="js-gombolola">
                    <option value="">Londa Eggombolola Lyo</option>
                  </select>
                  
                </div>
                <div class="form-group<?php echo  $errors->has('omuziro')?' has-error':'' ; ?>">
                  <label class="" title="Totem">Omuziro:</label>
                    <select name="omuziro" class="form-control">
                      <option value="" title="Select your totem">Londa Omuziro</option>
                      <?php foreach($ebika as $ekika): ?>
                        <option value="<?php echo  $ekika ; ?>"><?php echo  $ekika ; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php if($errors->has('omuziro')): ?>
                      <span class="help-block"><?php echo  $errors->first('omuziro') ; ?></span>
                    <?php endif; ?>
                </div>
            
                <div class="form-group<?php echo  $errors->has('father')?' has-error':'' ; ?>">
                  <label for="fathername" title="Father's name">Ndi mutabani wa / Muwala wa</label>
                  <input class="form-control" id="fathername" placeholder="Elinya lya taata" name="father" type="text" value="<?php echo  $request->old('father')?:'' ; ?>">
                </div>
                <div class="form-group col-sm-6<?php echo  $errors->has('father_grand_father')?' has-error':'' ; ?>">
                  <label for="jjajja"r title="Grand Father">Ndi muzzukulu wa</label>
                  <input class="form-control" id="jjajja" placeholder="Jajja omusajja/Grand Father" name="father_grand_father" type="text" value="<?php echo  $request->old('father_grand_father')?:'' ; ?>">
                </div>
                <div class="form-group col-sm-6<?php echo  $errors->has('father_grand_mother')?' has-error':'' ; ?>">
                  <label for="jjajja2" title="Grand Mother">Ne:</label>
                  <input class="form-control" id="jjajja2" name="father_grand_mother" placeholder="Jajja Mukyala/Grand Mother" type="text" value="<?php echo  $request->old('father_grand_mother')?:'' ; ?>">
                </div>
                <div class="form-group<?php echo  $errors->has('mother')?' has-error':'' ; ?>">
                  <label for="mothername" title="Mother's Name">Mange ye?</label>
                  <input class="form-control" id="mothername" placeholder="Amanya ga maama" name="mother" type="text" value="<?php echo  $request->old('mother')?:'' ; ?>">
                </div>
                <div class="form-group col-sm-6<?php echo  $errors->has('mother_grand_father')?' has-error':'' ; ?>">
                  <label for="jjajja3" title="Grand Father on mother's side">Muwala wa</label>
                  <input class="form-control" id="jjajja3" placeholder="Jjaja mwami ku ludda lwa maama" name="mother_grand_father" type="text" value="<?php echo  $request->old('mother_grand_father')?:'' ; ?>">
                </div>
                <div class="form-group col-sm-6<?php echo  $errors->has('mother_grand_mother')?' has-error':'' ; ?>">
                  <label for="jjajja4">Ne:</label>
                  <input class="form-control" id="jjajja4" placeholder="Jjaja Mukyaala ku ludda lwa maama" name="mother_grand_mother" type="text" value="<?php echo  $request->old('mother_grand_mother')?:'' ; ?>">
                </div>
                
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="save">Awaddako</button>
                <button type="submit" class="btn btn-success" name="skip">Buukawo</button>
              </div>
            </form>
          </div>

           
			<?php elseif($step == 3): ?>
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title col-sm-8">Omutendera Ogwokusatu</h3>
              <h4 class="box-title col-sm-4">Ebyensoma N'okukola</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form role="form" method="post" action="<?php echo  route('user.register.step', ['step' => Auth::user()->status]) ; ?>">
              <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
              <div class="box-body">
                <div class="form-group<?php echo  $errors->has('primary_school')?' has-error':'' ; ?>">
                  <label for="primary" title="primary school">Primary yo</label>
                  <input class="form-control" id="primary" name="primary_school" placeholder="primary school" type="text" value="<?php echo  $request->old('primary_school')?:'' ; ?>">
                </div>
                <div class="form-group<?php echo  $errors->has('secondary_school')?' has-error':'' ; ?>">
                  <label for="secondary">Secondary yo</label>
                  <input class="form-control" id="secondary" name="secondary_school" placeholder="secondary school" type="text" value="<?php echo  $request->old('secondary_school')?:'' ; ?>">
                </div>

                <div class="form-group<?php echo  $errors->has('higher_institution')?' has-error':'' ; ?>">
                  <label for="higher_institution">Ettendekero ekkulu:</label>
                  <input class="form-control" id="higher_institution" name="higher_institution" placeholder="Ettendekero/institution/university" type="text" value="<?php echo  $request->old('higher_institution')?:'' ; ?>">
                </div>
                <div class="form-group<?php echo  $errors->has('workplace')?' has-error':'' ; ?>">
                  <label for="job" title="Job title">Omulimu:</label>
                  <input class="form-control" id="job" name="workplace" placeholder="omulimu/job" type="text" value="<?php echo  $request->old('workplace')?:'' ; ?>">
                </div>
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="save">Awaddako</button>
                <button type="submit" class="btn btn-success" name="skip">Buukawo</button>
              </div>
            </form>
          </div>
		    <?php else: ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title col-sm-9">Omutendera Ogusembayo</h3>
              <h4 class="box-title col-sm-3">Ebikunyumira?</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form action="<?php echo  route('user.register.step', ['step' => Auth::user()->status]) ; ?>" method="post">
                  <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="css/dist/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="css/dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                <div class="box-footer">
                  <button type="submit" name="save" class="btn btn-primary col-xs-12 col-sm-6">Awaddako</button>
                </div>
              </form>
          </div>
          <?php endif; ?>
          </section>
          <section class="col-sm-4">
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
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
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
                        <img src="css/dist/img/default-50x50.gif" alt="Product Image">
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
  </div>
<?php $this->endSection() ?>