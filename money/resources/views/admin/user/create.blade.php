@include("admin.common.head")
<div class="admin-main fadeInUp animated" ng-app="hd" ng-controller="ctrl">
    <fieldset class="layui-elem-field layui-field-title">
        <legend></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
    	@csrf
        <div class="layui-form-item">
            <label class="layui-form-label">用户组名</label>
            <div class="layui-input-4">
                <input type="text" name="title" ng-model="field.title" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}用户组名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">{{$lang['submit']}}</button>
                <a href="/admin/user" class="layui-btn layui-btn-primary">{{$lang['back']}}</a>
            </div>
        </div>
    </form>
</div>
@include('admin.common.foot')
<script src="/static/common/js/angular.min.js"></script>
<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function($scope) {
        $scope.field = {title:''};
        layui.use(['form', 'layer'], function () {
            var form = layui.form, layer = layui.layer,$= layui.jquery;
            form.on('submit(submit)', function (data) {
                loading = layer.load(1,{shade:[0.1,'#fff']});
                // 提交到方法 默认为本身
                // data.field.group_id = $scope.field.group_id;
                $.post("/admin/user", data.field, function (res) {
                    layer.close(loading);
                    if (res.code > 0) {
                        layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                            location.href = res.url;
                        });
                    } else {
                        layer.msg(res.msg, {time: 1800, icon: 2});
                    }
                });
            })
        });
    }]);
</script>