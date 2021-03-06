          <div class="right_col" role="main">


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>PESAN MASUK</h2>
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
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Tujuan</th>
                          <th>Isi Pesan</th>
                          <th>Waktu Masuk</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                          foreach ($inbox->results as $msg) { ?>
                        <tr>
                          <td><?=$msg->contact->name!=null?$msg->contact->name:str_replace("tel:", "", $msg->urn)?></td>
                          <td><?=$msg->text?></td>
                          <td><?=$msg->sent_on?></td>
                        </tr>
                        <?php
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>