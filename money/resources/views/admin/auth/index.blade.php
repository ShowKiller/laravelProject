@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>{{$lang['admin']}}{{$lang['list']}}</legend>
    </fieldset>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>

@include('admin.common.foot')
<script type="text/html" id="barDemo">
    <a href="/admin/auth/1/edit" class="layui-btn layui-btn-xs">{{$lang['edit']}}</a>
    
</script>

<script type="text/html" id="topBtn">
   <a href="/admin/auth/create" class="layui-btn layui-btn-sm">{{$lang['add']}}{{$lang['admin']}}</a>
</script>
<script>
    layui.use(['table','form'], function() {
        var table = layui.table,form = layui.form,$ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '/admin/auth',
            method:'post',
			toolbar: '#topBtn',
			title:'{{$lang["admin"]}}{{$lang["list"]}}',
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cols: [[
                {field:'admin_id', title: '编号', width:60,fixed: true}
                ,{field:'username', title: '用户名', width:80}
				,{field:'title', title: '{{$lang["userGroup"]}}', width:200}
                ,{field:'email', title: '邮箱', width:200}
                ,{field:'tel', title: '{{$lang["tel"]}}', width:150}
                ,{field:'ip', title: '{{$lang["ip"]}}',width:150,hide:true}
                ,{field:'is_open', title: '{{$lang["status"]}}',width:150,toolbar: '#open'}
                ,{width:160, align:'center', toolbar: '#barDemo'}
            ]]
        });
        form.on('switch(open)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var is_open = obj.elem.checked===true?1:0;
            $.post('{:url("adminState")}',{'id':id,'is_open':is_open},function (res) {
                layer.close(loading);
                if (res.status==1) {
                    tableIn.reload();
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    return false;
                }
            })
        });
        table.on('tool(list)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('{:lang("Are you sure you want to delete it")}', function(index){
                    $.post("{:url('adminDel')}",{admin_id:data.admin_id},function(res){
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            obj.del();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                    layer.close(index);
                });
            }
        });

    });
</script>
</body>
</html>