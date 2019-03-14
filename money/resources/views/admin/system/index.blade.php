@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>{{$lang['systemSet']}}</legend>
    </fieldset>
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">基础设置</li>
            <li>SEO管理</li>
            <li>其他</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form layui-form-pane" lay-filter="form-system">
                    @csrf
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['websiteName']}}</label>
                        <div class="layui-input-4">
                            <input type="text"name="name" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}{{$lang['websiteName']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['WebsiteUrl']}}</label>
                        <div class="layui-input-4">
                            <input type="text" name="url" lay-verify="url" placeholder="{{$lang['pleaseEnter']}}{{$lang['WebsiteUrl']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站LOGO</label>
                        <input type="hidden" name="logo" id="logo">
                        <div class="layui-input-block">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn layui-btn-primary"  id="logoBtn"><i class="icon icon-upload3"></i>点击上传</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" id="cltLogo">
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['recordNum']}}</label>
                        <div class="layui-input-3">
                            <input type="text" name="bah" placeholder="{{$lang['pleaseEnter']}}{{$lang['recordNum']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Copyright</label>
                        <div class="layui-input-3">
                            <input type="text" name="copyright" placeholder="{{$lang['pleaseEnter']}}Copyright" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['companyAddress']}}</label>
                        <div class="layui-input-3">
                            <input type="text" name="ads" placeholder="{{$lang['pleaseEnter']}}{{$lang['companyAddress']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['tel']}}</label>
                        <div class="layui-input-3">
                            <input type="text" name="tel" placeholder="{{$lang['pleaseEnter']}}{{$lang['tel']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['email']}}</label>
                        <div class="layui-input-3">
                            <input type="text" name="email" placeholder="{{$lang['pleaseEnter']}}{{$lang['email']}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="button" class="layui-btn" lay-submit="" lay-filter="sys">{{$lang['submit']}}</button>
                            <button type="reset" class="layui-btn layui-btn-primary">{{$lang['reset']}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form layui-form-pane" lay-filter="form-system">
                    @csrf
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$lang['seoTitle']}}</label>
                        <div class="layui-input-4">
                            <input type="text"name="title" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}{{$lang['WebsiteUrl']}}" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">{{$lang['seoKeyword']}}</label>
                        <div class="layui-input-block">
                            <textarea name="key" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}{{$lang['seoKeyword']}}" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">{{$lang['description']}}</label>
                        <div class="layui-input-block">
                            <textarea name="des" lay-verify="required" placeholder="{{$lang['pleaseEnter']}}{{$lang['description']}}" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="button" class="layui-btn" lay-submit="" lay-filter="sys">{{$lang['submit']}}</button>
                            <button type="reset" class="layui-btn layui-btn-primary">{{$lang['reset']}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form layui-form-pane" lay-filter="form-system">
                    @csrf
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机端</label>
                        <div class="layui-input-block">
                            <input type="radio" name="mobile" value="open" title="开启">
                            <input type="radio" name="mobile" value="close" title="关闭">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">验证码</label>
                        <div class="layui-input-block">
                            <input type="radio" name="code" value="open" title="开启">
                            <input type="radio" name="code" value="close" title="关闭">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="button" class="layui-btn" lay-submit="" lay-filter="sys">{{$lang['submit']}}</button>
                            <button type="reset" class="layui-btn layui-btn-primary">{{$lang['reset']}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@include('admin.common.foot')
<script>
    layui.use(['form', 'layer','upload','element'], function () {
        var form = layui.form,layer = layui.layer,upload = layui.upload,$ = layui.jquery,element = layui.element;
        var seytem = {!!$system!!};
        form.val("form-system", seytem);
        $('#cltLogo').attr('src',seytem.logo);

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#logoBtn',
            url: '/api/uploadpic',
            before: function(obj){
                
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#cltLogo').attr('src', result); //图片链接（base64）
                });
            },
            done: function(res){
                //上传成功
                if(res.code>0){
                    $('#logo').val(res.url);
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
        //weishatijiao不行
        //提交监听
        form.on('submit(sys)', function (data) {
            console.log(data.field);
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post("/admin/system",data.field,function(res){
                layer.close(loading);
                var res = JSON.parse(res);
                if(res.code > 0){
                    layer.msg(res.msg,{icon: 1, time: 1000},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{icon: 2, time: 1000});
                }
            });
        })
    })
</script>
</body>
</html>