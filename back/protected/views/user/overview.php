<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/">User</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $user['id']; ?>/"><?php echo $user['email'] ?></a> <span class="divider">/</span> </li>
    <li class="active">Overview </li>
</ul>
<hr/>
<div id="overview-user">

    <legend>Account information <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $user['id']; ?>/" class="btn btn-warning">Edit</a></legend>
    <div class="information clearfix">        
        <ul>
            <li><strong>ID:</strong> #<?php echo $user['id'] ?></li>
            <li>
                <strong>Email:</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $user['id']; ?>/"><?php echo $user['email'] ?></a>
                <?php if ($user['deleted']): ?>
                    <span class="label label-important">Suspend</span>
                <?php endif; ?>
            </li>
            <li><strong>Date added:</strong> <?php echo date('d-m-Y H:i:s', $user['date_added']); ?> <i>(<?php echo DateTimeFormat::nicetime($user['date_added']); ?>)</i></li>
            <li><strong>Last name:</strong> <?php echo $user['lastname']; ?></li>
            <li><strong>First name:</strong> <?php echo $user['firstname']; ?></li>
            <li><strong>Status:</strong> <span class="label <?php if (!$user['disabled']) echo 'label-success' ?>"><?php echo $user['disabled'] ? "Disabled" : "Active"; ?></span></li>
            <li><strong>Role:</strong> <span class="label label-warning"><?php echo $user['role']; ?></span></li>
            <li><strong>Amount:</strong> <span class="label label-info"><?php echo number_format($user['amount']); ?>đ</span></li>
            <li><strong>Total cards used:</strong> <span class="label "><?php echo $total_card ?></span></li>
            <li><strong>Total coupons used:</strong> <span class="label "><?php echo $total_coupon ?></span></li>
            <li><strong>Total posts created:</strong> <span class="label "><?php echo $total_post; ?></span></li>
            <li><strong>Total normal tests created:</strong> <span class="label "><?php echo $total_test ?></span></li>
            <li><strong>Total normal tests completed:</strong> <span class="label "><?php echo $total_finish_test ?></span></li>
        </ul>

        <img class="avatar img-polaroid" src="<?php echo HelperApp::get_thumbnail($user['thumbnail']); ?>" />
    </div>


    <legend>Transactions (<?php echo $total_transaction; ?>)</legend>
    <div class="transaction block">        
        <table class="table table-center table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Amount</th>      
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total_transaction == 0): ?>
                    <tr>
                        <td colspan="5">No record</td>
                    </tr>
                <?php endif; ?>

                <?php $time = 0; ?>
                <?php foreach ($transactions as $k => $v): ?>
                    <?php if ($k == 0 || $time != date('d-m-Y', $v['date_added'])): ?>
                        <?php $time = date('d-m-Y', $v['date_added']); ?>
                        <tr>
                            <td colspan="6" class="align-left"><strong><?php echo $time; ?></strong></td>
                        </tr>
                    <?php endif; ?>
                    <tr>

                        <td>#<?php echo $v['id']; ?></td>
                        <td><?php echo date('H:i', $v['date_added']); ?></td>    
                        <td class="align-left">
                            <?php if ($v['ref_type'] == "card"): ?>
                                <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/card/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['card_code'] ?></a>
                                <span class="label label-success"><?php echo $v['ref_type'] ?></span>
                            <?php elseif ($v['ref_type'] == "coupon"): ?>
                                <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['coupon_code'] ?></a>
                                <span class="label label-warning"><?php echo $v['ref_type'] ?></span>
                            <?php elseif ($v['ref_type'] == "buy_nt_test"): ?>
                                <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['test_title'] ?></a>
                                <span class="label"><?php echo $v['ref_type'] ?></span>
                            <?php endif; ?>
                        </td>                        
                        <td><span class="label <?php echo $v['amount'] > 0 ? "label-info" : "label-important"; ?>"><?php echo number_format($v['amount']); ?>đ</span></td>

                        <td><?php echo $v['description'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/transaction/?uid=<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>

    <legend>Recent Cards (<?php echo $total_card ?>)</legend>
    <div class="cards block">
        <table class="table table-bordered table-striped table-center class">
            <thead>
                <tr>          
                    <th style="width:25%">Title</th>
                    <th>Card Types</th>
                    <th class="row-datetime">Date Add</th>
                    <th class="row-datetime">Date Exp</th>        
                    <th class="row-edit"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cards) < 1): ?>
                    <tr>
                        <td colspan="5" class="align-center">No record</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($cards as $s): ?>
                    <tr>
                        <td>
                            <a class="link" href="<?php echo Yii::app()->request->baseUrl . "/card/edit/id/" . $s['id']; ?>"><?php echo $s['title'] ?></a>                            
                        </td>  
                        <td>
                            Name: <?php echo $s['card_type_name'] ?><br/>
                            Amount: <span class="label label-info"><?php echo number_format($s['amount']); ?>đ</span>
                        </td>       

                        <td><?php echo date('d-m-Y H:i:s', $s['date_added']); ?></td>  
                        <td><?php echo date('d-m-Y H:i:s', $s['date_expired']); ?></td>  

                        <td>
                            <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/card/edit/id/" . $s['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/?uid=<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>

    <legend>Recent Coupons (<?php echo $total_coupon; ?>)</legend>
    <div class="coupons block">
        <table class="table table-bordered table-striped table-center class">
            <thead>
                <tr>          
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Total Users</th>
                    <th class="row-datetime">Date Added</th>      
                    <th class="row-datetime">Date Used</th>
                    <th class="row-edit"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($coupons) < 1): ?>
                    <tr>
                        <td colspan="6" class="align-center">No record</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($coupons as $s): ?>
                    <tr>
                        <td>
                            <a class="link" href="<?php echo Yii::app()->request->baseUrl . "/coupon/edit/id/" . $s['id']; ?>"><?php echo $s['title'] ?></a>
                            <?php if ($s['deleted']): ?>
                                <span class="label label-important">Deleted</span>
                            <?php endif; ?>
                        </td>  
                        <td><span class="label label-info"><?php echo number_format($s['amount']); ?>đ</span></td>                
                        <td><a class="link" href="#"><?php echo $s['total']; ?></a></td>
                        <td><?php echo date('d-m-Y H:i:s', $s['date_added']); ?></td>  
                        <td><?php echo date('d-m-Y H:i:s', $s['date_used']); ?></td>  
                        <td>
                            <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/coupon/edit/id/" . $s['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/user/id/<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>

    <legend>Recent Posts (<?php echo $total_post; ?>)</legend>
    <div class="posts block">
        <table class="table table-bordered table-striped table-center class">
            <thead>
                <tr>          
                    <th style="">Title</th>
                    <th>Subject & School</th>
                    <th class="row-datetime">Date Added</th>
                    <th class="row-edit"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($posts) < 1): ?>
                    <tr>
                        <td colspan="5" class="align-center">No record</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($posts as $c): ?>
                    <tr>
                        <td style="text-align: left;">
                            <a class="link" rel="tooltip" title="<?php echo $c['title']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['id']; ?>"><?php echo Helper::string_truncate($c['title'], 100) ?></a><br/>                            
                            Like: <a href="#" class="label label-success"><?php echo $c['total_like'] ?></a><br/>
                            Comment: <a href="<?php echo Yii::app()->request->baseUrl; ?>/comment/?rid=<?php echo $c['id'] ?>" class="label label-success"><?php echo $c['total_comment'] ?></a>

                        </td>                            
                        <td style="text-align: left;">
                            <strong>Subject: </strong><a class="link" rel="tooltip" title="<?php echo $c['subject_name']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/subject/edit/id/" . $c['subject_id']; ?>"><?php echo Helper::string_truncate($c['subject_name'], 50) ?></a><br/>
                            <strong>School: </strong><a class="link" rel="tooltip" title="<?php echo $c['organization_name']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/organization/edit/id/" . $c['organization_id']; ?>"><?php echo Helper::string_truncate($c['organization_name'], 50) ?></a>
                        </td>    
                        <td><?php echo date('d-m-Y H:i:s', $c['date_added']); ?></td>
                        <td>
                            <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/post/?uid=<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>

    <legend>Recent Normal Tests Created (<?php echo $total_test ?>)</legend>
    <div class="tests block">
        <table class="table table-bordered table-striped table-center class">
            <thead>
                <tr>          
                    <th width="">Title</th>
                    <th>Sub & School</th>
                    <th>Price</th>
                    <th class="row-datetime">Date Added</th>
                    <th class="row-edit"></th>

                </tr>
            </thead>
            <tbody>
                <?php if (count($tests) < 1): ?>
                    <tr>
                        <td colspan="5" class="align-center">No record</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($tests as $s): ?>
                    <tr>
                        <td class="align-left">
                            <a class="link" rel="tooltip" title="<?php echo $s['title'] ?>" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>"><?php echo Helper::string_truncate($s['title'], 100); ?></a>
                            <?php if ($s['disabled']): ?>
                                <span class="label label-warning">Disabled</span>
                            <?php endif; ?>


                            <br/>
                            Comments: <a href="<?php echo Yii::app()->request->baseUrl; ?>/comment/index/type/test_nt/?rid=<?php echo $s['id']; ?>" class="label label-success"><?php echo $s['total_comment']; ?></a>
                            <br/>
                            Questions: <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/question/id/<?php echo $s['id']; ?>" class="label label-warning"><?php echo (int) $s['total_question']; ?></a>
                            <br/>
                            Images: <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/image/id/<?php echo $s['id']; ?>" class="label label-info"><?php echo (int) $s['total_image']; ?></a>

                        </td>    
                        <td class="align-left">
                            School: <a rel="tooltip" title="<?php echo $s['org_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['org_title'], 50) ?></a> <br/>
                            Faculty: <a rel="tooltip" title="<?php echo $s['faculty_name']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['faculty_name'], 50) ?></a> <br/>
                            Sub: <a rel="tooltip" title="<?php echo $s['subject_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['subject_title'], 50) ?></a>
                        </td>
                        <td>
                            <?php if ($s['price'] == 0): ?>
                                <span class="label label-success">Free</span>
                            <?php else: ?>
                                <span class="label label-info"><?php echo number_format($s['price']) . "đ"; ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d-m-Y H:i:s', $s['date_added']); ?></td>
                        <td>
                            <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>">Edit</a>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/?uid=<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>

    <legend>Recent Normal Test Completed (<?php echo $total_finish_test; ?>)</legend>
    <div class="finish-tests block">
        <table class="table table-bordered table-striped table-center class">
            <thead>
                <tr>          
                    <th width="">Title</th>
                    <th>Sub & School</th>
                    <th class="row-edit">Result</th>
                    <th class="row-date">Date</th>
                    <th class="row-edit"></th>

                </tr>
            </thead>
            <tbody>
                <?php if (count($finish_tests) < 1): ?>
                    <tr>
                        <td colspan="5" class="align-center">No record</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($finish_tests as $s): ?>
                    <tr>
                        <td class="align-left">
                            <a class="link" rel="tooltip" title="<?php echo $s['title'] ?>" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>"><?php echo Helper::string_truncate($s['title'], 100); ?></a>
                            <?php if ($s['disabled']): ?>
                                <span class="label label-warning">Disabled</span>
                            <?php endif; ?>

                            <br/>Section: <?php echo $s['section_title']; ?><br/>
                            Author: <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $s['author_id']; ?>"><?php echo $s['author_title'] ?></a>
                        </td>    
                        <td class="align-left">
                            School: <a rel="tooltip" title="<?php echo $s['org_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['org_title'], 50) ?></a> <br/>
                            Faculty: <a rel="tooltip" title="<?php echo $s['faculty_name']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['faculty_name'], 50) ?></a> <br/>
                            Sub: <a rel="tooltip" title="<?php echo $s['subject_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['subject_title'], 50) ?></a>
                        </td>                         

                        <td>
                            <span class="label label-success"><?php echo $s['total_right'] . "/" . $s['total_question']; ?></span>
                        </td>
                        <td><?php echo date('d-m-Y H:i:s', $s['date_completed']); ?></td>
                        <td>
                            <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/testNT/view_finished/id/" . $s['relationship_id']; ?>">View</a>                    
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/finish/?uid=<?php echo $user['id']; ?>" class="btn btn-warning pull-right">More</a></p>
    </div>
</div>