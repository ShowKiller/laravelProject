@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>{{$title}}</legend>
    </fieldset>
    <form action="" class="layui-form layui-form-pane" lay-filter="form">
        @method('PUT')
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">所属用户组</label>
            <div class="layui-input-4">
                <select name="group_id" lay-verify="required">
                    <option value="">请选择用户组</option>
                    @foreach ($authGroup as $key => $value)
                    <option value="{{$value->group_id}}">{{$value->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$lang['username']}}</label>
            <div class="layui-input-4">
                <input type="text" name="username"  lay-verify="required" placeholder="{{$lang['pleaseEnter']}}登录用户名" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                用户名在4到25个字符之间。
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$lang['pwd']}}</label>
            <div class="layui-input-4">
                <input type="password" name="pwd" placeholder="{{$lang['pleaseEnter']}}登录密码" {if condition="ACTION_NAME eq 'adminadd'"}lay-verify="required"{/if} class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                密码必须大于6位，小于15位。
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">头像</label>
            <input type="hidden" name="avatar" id="avatar">
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-primary" id="adBtn"><i class="icon icon-upload3"></i>点击上传</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" id="adPic">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$lang['email']}}</label>
            <div class="layui-input-4">
                <input type="text" name="email" lay-verify="email" placeholder="{{$lang['pleaseEnter']}}用户邮箱" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                用于密码找回，请认真填写。
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{$lang['tel']}}</label>
            <div class="layui-input-4">
                <input type="text" name="tel" lay-verify="phone" value="" placeholder="{{$lang['pleaseEnter']}}手机号" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" name="admin_id">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">{{$lang['submit']}}</button>
                <a href="/admin/auth" class="layui-btn layui-btn-primary">{{$lang['back']}}</a>
            </div>
        </div>
    </form>
</div>
@include('admin.common.foot')
<script>
    layui.use(['form', 'layer','upload'], function () {
        var form = layui.form, layer = layui.layer,$= layui.jquery,upload = layui.upload;
        var info = {!!$info!!};
        form.val("form", info);
        if(info){
            $('#adPic').attr('src',info.avatar);
        }
        form.render();
        form.on('submit(submit)', function (data) {
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post("/admin/auth/{{$data->admin_id}}", data.field, function (res) {
                layer.close(loading);
                if (res.code > 0) {
                    layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                        location.href = res.url;
                    });
                } else {
                    layer.msg(res.msg, {time: 1800, icon: 2});
                }
            });
        });
        var uploadInst = upload.render({
            elem: '#adBtn',
            url: '/api/uploadpic',
            before: function(obj){
                
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#adPic').attr('src', result); //图片链接（base64）
                });
            },
            done: function(res){
                //上传成功
                if(res.code>0){
                    $('#avatar').val(res.url);
                }else{
                    //如果上传失败
                    return layer.msg('上传失败');
                }
            },
            error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>