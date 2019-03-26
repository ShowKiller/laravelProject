@include('admin.common.head')
<div style="margin: 15px;" class="fadeInUp animated">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>添加权限</legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        1、《控/方》：意思是 控制器/方法; 例如 Sys/sysList<br/>
        2、图标名称为左侧导航栏目的图标样式，具体可查看<a href="https://icomoon.io/app/#/select" target="_blank">premium</a>图标
    </blockquote>
    <form class="layui-form layui-form-pane">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">父级</label>
            <div class="layui-input-4">
                <select name="pid" lay-verify="required" lay-filter="pid" >
                    <option value="0">默认顶级</option>
                    @foreach($info as $key => $value)
                        <option value="{{$value->id}}">{{$value->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限名称</label>
            <div class="layui-input-4">
                <input type="text" name="title" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}权限名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">控制器/方法</label>
            <div class="layui-input-4">
                <input type="text" name="href" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}控制器/方法" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图标名称</label>
            <div class="layui-input-4">
                <input type="text" name="icon" placeholder="{:lang('pleaseEnter')}图标名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">菜单状态</label>
            <div class="layui-input-block">
                <input type="radio" name="menustatus" lay-filter="menustatus" checked value="1" title="开启">
                <input type="radio" name="menustatus" lay-filter="menustatus" value="0" title="关闭">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-2">
                <input type="text" name="sort" value="50" placeholder="{{$lang['pleaseEnter']}}排序编号" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="auth">立即提交</button>
                <a href="/admin/authority" class="layui-btn layui-btn-primary">返回</a>
            </div>
        </div>
    </form>
</div>
@include('admin.common.foot')
<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form,layer = layui.layer,$= layui.jquery;
        form.on('submit(auth)', function (data) {
            // 提交到方法 默认为本身
            $.post("/admin/authority",data.field,function(res){
                if(res.code > 0){
                    layer.msg(res.msg,{time:1000,icon:1},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                }
            });
        })
    });
</script>