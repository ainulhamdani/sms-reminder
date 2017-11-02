          <div class="right_col" role="main">

            <div class="x_panel">
              <div class="x_title">
                <h2>PESAN BARU</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <form action="<?=base_url()?>sms/send" method="post">
                  
                <div class="row">
                    <div class="control-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Penerima</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="numbers" type="text" class="tags form-control" required="required" name="numbers" />
                        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                      </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Pesan
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="1" data-parsley-maxlength="720" data-parsley-validation-threshold="10" rows="6"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <button class="btn btn-success btn-lg" type="submit">Kirim</button>
                        </div>
                      </div>                

                </div>

                </form>

          </div>