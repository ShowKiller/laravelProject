@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>用户组列表</legend>
    </fieldset>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
@include('admin.common.foot')

<script type="text/html" id="action">
    <a href="/admin/user/rule/@{{d.group_id}}" class="layui-btn layui-btn-xs layui-btn-normal">配置规则</a>
    <a href="/admin/user/@{{d.group_id}}/edit" class="layui-btn layui-btn-warm layui-btn-xs">{{$lang['edit']}}</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">{{$lang['del']}}</a>
</script>
<script type="text/html" id="topBtn">
   <a href="/admin/user/create" class="layui-btn layui-btn-sm">{{$lang['add']}}用户组</a>
</script>
<script>

    layui.use('table', function() {
        var table = layui.table,$ = layui.jquery;
        table.render({
            elem: '#list',
            url: '/admin/user',
            method:'GET',
			toolbar: '#topBtn',
			title:'用户组列表',
            cols: [[
                {field:'group_id', title: '{{$lang["id"]}}',width:80, fixed: true,sort: true},
                {field:'title', title: '用户组名', width:180},
                {field:'addtime', title: '添加时间', width:200,sort: true},
                {width:260, align:'center',toolbar:'#action'}
            ]]
        });
        table.on('tool(list)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('你确定要删除该分组吗？', function(index){
                    loading =layer.load(1, {shade: [0.1,'#fff']});
                    $.post("/admin/user/" + data.group_id,{id:data.group_id,_token:'{{csrf_token()}}',_method:'DELETE'},function(res){
                        layer.close(loading);
                        layer.close(index);
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            obj.del();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>