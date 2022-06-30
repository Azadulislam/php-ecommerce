<?php
    $title = "Admin || Demo shop";
    include_once "inc/header.php";
    $dir = "../uploads/";
    $selectAl = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='2'");
    $countVen = mysqli_num_rows($selectAl);
    $selectAllCustomer = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='1'");
    $countCustomer = mysqli_num_rows($selectAllCustomer);
    $selectSelles = $db->rnQuery("SELECT * FROM `orders` WHERE `status`='1'");
    $countSellese = mysqli_num_rows($selectSelles);
?>
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row" data-toggle="tooltip" title="This section is not functional, it will be functional son">
                                    <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light">$3249</h3>
                                        <h5 class="text-muted m-b-0">Total Revenue</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning"><i class="fas fa-user-astronaut"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?= $countVen ?></h3>
                                        <h5 class="text-muted m-b-0">Total Vendor</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="fas fa-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?= $countCustomer ?></h3>
                                        <h5 class="text-muted m-b-0">Total Customer</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="fas fa-people-carry"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?= $countSellese ?></h3>
                                        <h5 class="text-muted m-b-0">Total Sales</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Vendors</h4>
                            <!-- Comment widgets -->
                            <div class="comment-widgets">
                                <!-- Comment Row -->
                                <?php 
                                    $selectPv = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='2' LIMIT 0,3");
                                    While($item = mysqli_fetch_assoc($selectPv)){
                                ?>
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2"><span class="round"><img src="<?= $dir ?><?= $item['profile'] ?>" alt="user" width="50"></span></div>
                                    <div class="comment-text w-100">
                                        <h5><?= $item['fname'] ?> <?= $item['lname'] ?></h5>
                                        <p class="m-b-5">From: <?= $item['address1'] ?></p>
                                        <div class="comment-footer"> 
                                            <span class="text-muted pull-right"><?= date("M d Y ",  strtotime($item['time'])) ?></span>
                                            <?php if($item['status']==1){ ?> 
                                            <span class="label label-success">Active</span>
                                            <?php }else{ ?>
                                            <span class="label label-danger">Pending</span>
                                            <?php } ?>
                                            <!-- <span class="action-icons">
                                                <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-heart"></i></a>    
                                            </span>  -->
                                        </div>
                                    </div>
                                    <div width="100px" class="py-3">
                                        <a href="vendor.php" class="btn btn-info">Take action</a>
                                    </div>
                                </div>
                                <?php 
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <button class="pull-right btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#myModal">Add Task</button>
                                <h4 class="card-title">To Do list</h4>
                                <!-- ============================================================== -->
                                <!-- To do list widgets -->
                                <!-- ============================================================== -->
                                <div class="to-do-widget m-t-20">
                                    <!-- .modal for add task -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Task</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label>Task name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Task Name"> </div>
                                                        <div class="form-group">
                                                            <label>Assign to</label>
                                                            <select class="custom-select form-control pull-right">
                                                                <option selected="">Sachin</option>
                                                                <option value="1">Sehwag</option>
                                                                <option value="2">Pritam</option>
                                                                <option value="3">Alia</option>
                                                                <option value="4">Varun</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">
                                                <label for="inputSchedule" class=""> <span>Schedule meeting with</span> </label>
                                            </div>
                                            <ul class="assignedto">
                                                <li><img src="assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                                <li><img src="assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                                <li><img src="assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                                <li><img src="assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                            </ul>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                                                <label for="inputCall" class=""> <span>Give Purchase report to</span> <span class="label label-danger">Today</span> </label>
                                            </div>
                                            <ul class="assignedto">
                                                <li><img src="assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                                <li><img src="assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                            </ul>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputBook" name="inputCheckboxesBook">
                                                <label for="inputBook" class=""> <span>Book flight for holiday</span> </label>
                                            </div>
                                            <div class="item-date"> 26 jun 2017</div>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputForward" name="inputCheckboxesForward">
                                                <label for="inputForward" class=""> <span>Forward all tasks</span> <span class="label label-warning">2 weeks</span> </label>
                                            </div>
                                            <div class="item-date"> 26 jun 2017</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body mh-500">
                                <h4 class="card-title">Pending Orders</h4>
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Buyer</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $select = $db->rnQuery("SELECT * FROM `orders`");
                                                while($item = mysqli_fetch_assoc($select)){
                                                    $buyerid = $item['user_id'];
                                                    $buyers  = $db->rnQuery("SELECT * FROM `user` WHERE  `id`='$buyerid'");
                                                    $buyer   = mysqli_fetch_assoc($buyers);
                                            ?>
                                            <tr>
                                                <td><span class="text-info">#<?= $item['order-id'] ?></span></td>
                                                <td><?= $buyer['fname'].$buyer['lname'] ?></td>
                                                <td><?php if($item['payment']=='0'){ ?><span class="label label-danger">pneding</span><?php }else{ ?><span class="label label-success"><?= $item['payment'] ?></span><?php } ?></td>
                                                <td>
                                                    <div class="profile-text"> <a href="selles.php" class="dropdown-toggle u-dropdown btn btn-info" data-toggle="dropown" role="button" aria-haspopup="true" aria-expanded="true">Take Action</a>
                                                        <div class="dropdown-menu animated flipInY">
                                                            <a href="?status=<?= $item['id'] ?>&action=aprove" class="dropdown-item"><i class="fa fa-check"></i> Accept</a> 
                                                            <div class="dropdown-divider"></div> 
                                                            <a href="?status=<?= $item['id'] ?>&action=decline" class="dropdown-item"><i class="fa fa-times"></i> Deny</a>
                                                            <div class="dropdown-divider"></div> 
                                                            <a id="print" href="<?= URL ?>?view=<?= $item['id'] ?>&order?" class="dropdown-item not_working_alert" target="_blank"><i class="fa fa-eye"></i> View Details</a>
                                                        </div>
                                                    </div>
                                                </td>
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
                </div>
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                <?php
                    include_once ("inc/footer.php");
                ?>