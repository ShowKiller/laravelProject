@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>权限{{$lang['list']}}</legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        <a href="/admin/authority/create" class="layui-btn layui-btn-sm">{{$lang['add']}}节点</a>
        <a href="" class="layui-btn layui-btn-sm layui-btn-danger">清除节点</a>
        <a class="layui-btn layui-btn-normal layui-btn-sm"  onclick="openAll();">展开或折叠全部</a>
    </blockquote>
    <table class="layui-table" id="treeTable" lay-filter="treeTable"></table>
</div>
<script type="text/html" id="auth">
    <input type="checkbox" name="authopen" value="@{{d.id}}" lay-skin="switch" lay-text="是|否" lay-filter="authopen" @{{ d.authopen == 0 ? 'checked' : '' }}>
</script>
<script type="text/html" id="status">
    <input type="checkbox" name="menustatus" value="@{{d.id}}" lay-skin="switch" lay-text="显示|隐藏" lay-filter="menustatus" @{{ d.menustatus == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="order">
    <input name="@{{d.id}}" data-id="@{{d.id}}" class="list_order layui-input" value="@{{d.sort}}" size="10"/>
</script>
<script type="text/html" id="icon">
    <span class="icon @{{d.icon}}"></span>
</script>
<script type="text/html" id="action">
    <a href="/admin/authority/@{{d.id}}/edit" class="layui-btn layui-btn-xs">{{$lang['edit']}}</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">{{$lang['del']}}</a>
</script>
<script type="text/html" id="topBtn">
   <a href="/admin/authority/create" class="layui-btn layui-btn-sm">{{$lang['add']}}权限</a>
</script>
@include('admin.common.foot')
<script>
var editObj=null,ptable=null,treeGrid=null,tableId='treeTable',layer=null;
    layui.config({
        base: '/static/plugins/layui/extend/'
    }).extend({
        treeGrid:'treeGrid'
    }).use(['jquery','treeGrid','layer','form'], function(){
        var $=layui.jquery;
        treeGrid = layui.treeGrid;
        layer=layui.layer;
        form = layui.form;
        ptable=treeGrid.render({
            id:tableId
            ,elem: '#'+tableId
            ,idField:'id'
            ,url:'/admin/authority',
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method:'get',
            cellMinWidth: 100
            ,treeId:'id'//树形id字段名称
            ,treeUpId:'pid'//树形父id字段名称
            ,treeShowName:'title'//以树形式显示的字段
            ,height:'full-140'
            ,isFilter:false
            ,iconOpen:true//是否显示图标【默认显示】
            ,isOpenDefault:true//节点默认是展开还是折叠【默认展开】
            ,cols: [[
                {field: 'id', title: '{{$lang["id"]}}', width: 70, fixed: true},
                {field: 'icon', align: 'center',title: '{{$lang["icon"]}}', width: 60,templet: '#icon'},
                {field: 'title', title: '权限名称', width: 200},
                {field: 'href', title: '控制器/方法', width: 200},
                {field: 'authopen',align: 'center', title: '是否验证权限', width: 150,toolbar: '#auth'},
                {field: 'menustatus',align: 'center',title: '菜单{{$lang["status"]}}', width: 150,toolbar: '#status'},
                {field: 'sort',align: 'center', title: '{{$lang["order"]}}', width: 80, templet: '#order'},
                {width: 160,align: 'center', toolbar: '#action'}
            ]]
            ,page:false
        });
        treeGrid.on('tool('+tableId+')',function (obj) {
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('您确定要删除该记录吗？', function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("/destroy",{id:data.id},function(res){
                        layer.close(loading);
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
        form.on('switch(authopen)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var authopen = obj.elem.checked===true?0:1;
            $.post('/admin/authority/isvaildate',{'id':id,'authopen':authopen,_token:'{{csrf_token()}}'},function (res) {
                layer.close(loading);
                if (res.status==1) {
                    treeGrid.render;
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    treeGrid.render;
                    return false;
                }
            })
        });
        form.on('switch(menustatus)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var menustatus = obj.elem.checked===true?1:0;
            $.post('/admin/authority/state',{'id':id,'menustatus':menustatus,_token:'{{csrf_token()}}'},function (res) {
                layer.close(loading);
                if (res.status==1) {
                    treeGrid.render;
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    treeGrid.render;
                    return false;
                }
            })
        });
        $('body').on('blur','.list_order',function() {
           var id = $(this).attr('data-id');
           var sort = $(this).val();
           $.post('/admin/authority/order',{id:id,sort:sort,_token:'{{csrf_token()}}'},function(res){
                if(res.code==1){
                    layer.msg(res.msg,{time:1000,icon:1},function(){
                        location.href = res.url;

                    });
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    treeGrid.render;
                }
           })
        })
    });



function openAll() {
    var treedata=treeGrid.getDataTreeList(tableId);
    treeGrid.treeOpenAll(tableId,!treedata[0][treeGrid.config.cols.isOpen]);
}
</script>