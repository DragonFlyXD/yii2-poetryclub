<?php

/**
 * file setprofile.php 用户信息配置视图
 */
use yii\helpers\Url;

$this->title="个人信息";
?>
<div class="modal fade" id="u-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" style="font-size: 2em" type="button" class="close">&times;</button>
                <h3 class="modal-title">编辑个人信息</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/" id="u-form" method="post" name="u-form">
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label"
                                                     for="alias"><strong>昵称: </strong></strong></label></div>
                        <div class="col-lg-6">
                            <input class="form-control" id="alias" type="text" name="alias" autocomplete="off"
                                   placeholder="请输入昵称">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label"
                                                     for="position"><strong>职业: </strong></strong></label></div>
                        <div class="col-lg-6">
                            <input class="form-control" id="position" type="text" name="position"
                                   autocomplete="off" placeholder="请输入职位">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label"
                                                     for="city"><strong>所在地区: </strong></strong>
                            </label></div>
                        <div class="col-lg-6">
                            <input class="form-control" id="city" type="text" name="city" autocomplete="off"
                                   placeholder="请输入所在地区">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label"
                                                     for="birthday"><strong>生日: </strong></strong></label></div>
                        <div class="col-lg-6 form-inline">
                            <select class="sel-y form-control"> </select>年
                            <select class="sel-m form-control "> </select>月
                            <select class="sel-d form-control"> </select>日
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label gender-label"
                                                     for="city"><strong>性别: </strong></strong>
                            </label></div>
                        <div class="col-lg-6">
                            <label class="radio-inline">
                                <input type="radio" name="gender" class="" value="0" checked>保密
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" class="" value="1">男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" class="" value="2">女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"><label class="text-right center-block u-label"
                                                     for="city"><strong>个人签名: </strong></strong>
                            </label></div>
                        <div class="col-lg-6">
                                    <textarea name="signature" class="form-control" id="signature" cols="" rows=""
                                              placeholder="请输入个性签名" maxlength="140"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="u-sumbit"
                        data-url="<?= Url::to(['user/alter-ucenter']) ?>">确认
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<div class="u-title">
    <span class="text-left">个人信息</span>
    <?php if ($data['own_center']) : ?>
        <a href="javascript: void(0);" class="pull-right u-edit"><i class="fa fa-pencil"></i>编辑</a>
    <?php endif; ?>
</div>
<div class="u-line"></div>
<div class="u-info">
    <div class="info-box clearfix">
        <label class="pull-left">昵称</label>
        <div
            class="pull-left"><?= isset($data['alias']) ? $data['alias'] : "报-上-名-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
    <div class="info-box clearfix">
        <label class="pull-left">职业</label>
        <div
            class="pull-left"><?= isset($data['position']) ? $data['position'] : "报-上-职-业-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
    <div class="info-box clearfix">
        <label class="pull-left">城市</label>
        <div
            class="pull-left"><?= isset($data['city']) ? $data['city'] : "报-上-城-市-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
    <div class="info-box clearfix">
        <label class="pull-left">生日</label>
        <div
            class="pull-left"><?= isset($data['birthday']) ? $data['birthday'] : "报-上-生-日-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
    <div class="info-box clearfix">
        <label class="pull-left">性别</label>
        <div
            class="pull-left"><?= isset($data['gender']) ? $data['gender'] : "报-上-性-别-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
    <div class="info-box clearfix">
        <label class="pull-left">个人签名</label>
        <div
            class="pull-left"><?= isset($data['signature']) ? $data['signature'] : "报-上-墓-志-铭-来,伙-计,<i style='font-size: 2em' class='fa fa-user-secret'></i>,(⊙o⊙)…,我才没有结巴..." ?></div>
    </div>
</div>
