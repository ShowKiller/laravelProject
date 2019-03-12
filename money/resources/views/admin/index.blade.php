@include('admin.common.head')

<script>
    var ADMIN = '/static/admin';
    var navs = {!!$menus!!};
</script>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header">
        <div class="layui-main">
            <div class="admin-login-box">
                <a class="logo" style="left: 0;" href="{:url('admin/index/index')}">
                    <span style="font-size: 22px;"><!-- {:config('sys_name')} -->showKiller</span>
                </a>
                <div class="admin-side-toggle fs1">
                    <span class="icon icon-menu"></span>
                </div>
                <div class="admin-side-full">
                    <span class="icon icon-enlarge"></span>
                </div>
            </div>
            <ul class="layui-nav admin-header-item" lay-filter="side-top-right">
                <li class="layui-nav-item" id="cache">
                    <a href="javascript:;">{{$lang['clearCache']}}</a>
                </li>
                <li class="layui-nav-item">
                    <a href="{:url(config('app.default_module').'/index/index')}" target="_blank">{{$lang['home']}}</a>
                </li>
                <li class="layui-nav-item">
                    <a class="name" href="javascript:;">主题</a>
                    <dl class="layui-nav-child">
                        <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                        <dd data-skin="1"><a href="javascript:;">纯白</a></dd>
                        <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;" class="admin-header-user">
                        <img src="{:session('avatar')}" class="layui-nav-img" />
                        <span><!-- {:session('username')} -->showKiller</span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="{:url('index/logout')}"><i class="fa fa-sign-out" aria-hidden="true"></i>{{$lang['logout']}}</a>
                        </dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav admin-header-item-mobile">
                <li class="layui-nav-item">
                    <a href="{:url(config('app.default_module').'/index/index')}" target="_blank">{{$lang['home']}}</a>
                </li>
                <li class="layui-nav-item">
                    <a href="{:url('index/logout')}"><i class="fa fa-sign-out" aria-hidden="true"></i> {{$lang['logout']}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black" id="admin-side">
        <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
    </div>
    <div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
        <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">
                    <i class="icon icon-earth" aria-hidden="true"></i>
                    <cite>控制面板</cite>
                </li>
            </ul>
            <div class="layui-tab-content" style="min-height: 150px; padding: 0;">
                <div class="layui-tab-item layui-show">
                    <iframe src="/admin/main"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer footer footer-demo" id="admin-footer">
        <div class="layui-main">
            <p>2017 &copy;
                <a href="http://www.cltphp.com/">www.cltphp.com</a> Apache Licence 2.0
            </p>
        </div>
    </div>
    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>
    @include('admin.common.foot')
    <script src="/static/admin/js/index.js"></script>
    <script>
        layui.use('layer',function(){
            var $ = layui.jquery, layer = layui.layer;
            $('#cache').click(function () {
                document.cookie="skin=;expires="+new Date().toGMTString();
                layer.confirm('确认要清除缓存？', {icon: 3}, function () {
                    $.post('{:url("clear")}',function (data) {
                        layer.msg(data.info, {icon: 6}, function (index) {
                            layer.close(index);
                            window.location.href = data.url;
                        });
                    });
                });
            });
        })
    </script>
</div>
</body>
