<div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <?php foreach ($m_needstock->result() as $stock ): ?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

                <span class="count_top"><i ></i> <?php echo $stock->nama_barang; ?></span>
                <div class="count"><i class="gray"><?php echo $stock->qty; ?></i></div>
              <span class="count_bottom"><i class="green"><?php echo $stock->unit_id; ?> </i></span>
            </div>
          <?php endforeach ?>
          </div>
          <!-- /top tiles -->

          <br />

          <div class="row">

<!-- alat tulis -->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Alat Tulis</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($m_alat_tulis as $kat): ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $kat->nama_barang; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                      <?php $total=110;
                            $total_pensil=50;
                            $persentasi_pensil=round($kat->qty/$total_pensil * 100,2);
                            $persentasi=round($kat->qty/$total * 100,2); ?>

                      <?php if ($kat->nama_barang == 'PULPEN' OR $kat->nama_barang == 'PENSIL' AND $kat->qty < 25 AND $kat->qty > 10 OR $kat->qty ==15 ):?>
                        <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="<?php echo $total_pensil; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_pensil; ?>%</span>
                        </div>
                        <?php elseif ($kat->nama_barang == 'PULPEN' OR $kat->nama_barang == 'PENSIL' AND $kat->qty <30 ):?>
                        <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="<?php echo $total_pensil; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_pensil; ?>%</span>
                        </div>
                        <?php elseif ($kat->nama_barang == 'PULPEN' OR $kat->nama_barang == 'PENSIL'):?>
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="<?php echo $total_pensil; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_pensil; ?>%</span>
                        </div>
                        <?php elseif ($kat->qty < 55 AND $kat->qty > 35 OR $kat->qty ==35): ?>
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="110" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php elseif ($kat->qty <30): ?>
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="110" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php else: ?>
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $kat->qty; ?>"  aria-valuemax="110" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php endif ?>
                       </div>

                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $kat->qty; ?>,<i style="font-size: 70%;"><?php echo $kat->unit_id; ?></i></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>



            
            </div>
<!-- /alat tulis -->

<!-- kategori buku -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Buku</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($m_buku->result() as $kab): ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $kab->nama_barang; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <?php $total=101;
                      $persentasi=round($kat->qty/$total * 100,2); ?>
                        <?php if ($kab->qty < 50 AND $kab->qty > 30): ?>
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $kab->qty; ?>"  aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php elseif ($kab->qty <30): ?>
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $kab->qty; ?>"  aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php else: ?>
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $kab->qty; ?>"  aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php endif ?>
                       </div>

                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $kab->qty; ?>,<i style="font-size: 70%;"><?php echo $kab->unit_id; ?></i></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>
            
            
            </div>
<!-- /kategori buku -->


<!-- kategori kertas -->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Kertas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($m_kertas->result() as $kk): ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $kk->nama_barang; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                      
                        <?php $total=90;
                            $total_kertas=90;
                            $persentasi_kertas=round($kk->qty/$total_kertas * 100,2); ?>
                      
                        <?php if ($kk->qty < 55 AND $kk->qty > 35 OR $kk->qty ==35): ?>
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $kk->qty; ?>"  aria-valuemax="90" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_kertas; ?>%</span>
                        </div>
                        <?php elseif ($kk->qty <30): ?>
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $kk->qty; ?>"  aria-valuemax="90" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_kertas; ?>%</span>
                        </div>
                        <?php else: ?>
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $kk->qty; ?>"  aria-valuemax="90" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi_kertas; ?>%</span>
                        </div>
                        <?php endif ?>
                       </div>

                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $kk->qty; ?>,<i style="font-size: 70%;"><?php echo $kk->unit_id; ?></i></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>



            
            </div>
<!-- /kategori kertas -->

<!-- kategori umum -->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>File Organizer</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($m_filo->result() as $filo): ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $filo->nama_barang; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                      
                        <?php $total=101;
                            $persentasi=round($filo->qty/$total * 100,2); ?>
                      
                        <?php if ($filo->qty < 55 AND $filo->qty > 35 OR $filo->qty ==35): ?>
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $filo->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php elseif ($filo->qty <30): ?>
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $filo->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php else: ?>
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $filo->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php endif ?>
                       </div>

                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $filo->qty; ?>,<i style="font-size: 70%;"><?php echo $filo->unit_id; ?></i></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>



            
            </div>
<!-- /kategori umum -->

<!-- kategori umum -->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Umum</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php foreach ($m_umum->result() as $um): ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $um->nama_barang; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                      
                        <?php $total=101;
                            $persentasi=round($um->qty/$total * 100,2); ?>
                      
                        <?php if ($um->qty < 55 AND $um->qty > 35 OR $um->qty ==35): ?>
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $um->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php elseif ($um->qty <30): ?>
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $um->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php else: ?>
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $um->qty; ?>"  aria-valuemax="<?php echo $total; ?>" style="width: 66%;">
                          <span class="sr-only-focusable"><?php echo $persentasi; ?>%</span>
                        </div>
                        <?php endif ?>
                       </div>

                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $um->qty; ?>,<i style="font-size: 70%;"><?php echo $um->unit_id; ?></i></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>



            
            </div>
<!-- /kategori umum -->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Device Usage</h2>
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
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>IOS </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Android </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
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
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                        <h4>Profile Completion</h4>
                        <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">100%</span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities <small>Sessions</small></h2>
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
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">



              <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Visitors location <small>geo-presentation</small></h2>
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
                      <div class="dashboard-widget-content">
                        <div class="col-md-4 hidden-small">
                          <h2 class="line_30">125.7k Views from 60 countries</h2>

                          <table class="countries_list">
                            <tbody>
                              <tr>
                                <td>United States</td>
                                <td class="fs15 fw700 text-right">33%</td>
                              </tr>
                              <tr>
                                <td>France</td>
                                <td class="fs15 fw700 text-right">27%</td>
                              </tr>
                              <tr>
                                <td>Germany</td>
                                <td class="fs15 fw700 text-right">16%</td>
                              </tr>
                              <tr>
                                <td>Spain</td>
                                <td class="fs15 fw700 text-right">11%</td>
                              </tr>
                              <tr>
                                <td>Britain</td>
                                <td class="fs15 fw700 text-right">10%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">


                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>To Do List <small>Sample tasks</small></h2>
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

                      <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->
                
                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Daily active users <small>Sessions</small></h2>
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
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="temperature"><b>Monday</b>, 07:30 AM
                            <span>F</span>
                            <span><b>C</b></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="weather-icon">
                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <div class="weather-text">
                            <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="weather-text pull-right">
                          <h3 class="degrees">23</h3>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="row weather-days">
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Mon</h2>
                            <h3 class="degrees">25</h3>
                            <canvas id="clear-day" width="32" height="32"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Tue</h2>
                            <h3 class="degrees">25</h3>
                            <canvas height="32" width="32" id="rain"></canvas>
                            <h5>12 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Wed</h2>
                            <h3 class="degrees">27</h3>
                            <canvas height="32" width="32" id="snow"></canvas>
                            <h5>14 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Thu</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="sleet"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Fri</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="wind"></canvas>
                            <h5>11 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Sat</h2>
                            <h3 class="degrees">26</h3>
                            <canvas height="32" width="32" id="cloudy"></canvas>
                            <h5>10 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>