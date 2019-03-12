@include('admin.common.head')
<div class="admin-main layui-anim layui-anim-upbit">
    <div class="table-responsive">
        <table class="layui-table" lay-even lay-skin="line">
            <colgroup>
                <col width="40%">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th class="text-center" colspan="2">{:lang('systemInfo')}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>网站域名</td>
                <td>{$config.url}</td>
            </tr>
            <tr>
                <td>网站目录</td>
                <td>{$config.document_root}</td>
            </tr>
            <tr>
                <td>服务器操作系统</td>
                <td>{$config.server_os}</td>
            </tr>
            <tr>
                <td>服务器端口</td>
                <td>{$config.server_port}</td>
            </tr>
            <tr>
                <td>服务器IP</td>
                <td>{$config.server_ip}</td>
            </tr>
            <tr>
                <td>WEB运行环境</td>
                <td>{$config.server_soft}</td>
            </tr>
            <tr>
                <td>MySQL数据库版本</td>
                <td>{$config.mysql_version}</td>
            </tr>
            <tr>
                <td>运行PHP版本</td>
                <td>{$config.php_version}</td>
            </tr>

            <tr>
                <td>最大上传限制</td>
                <td>{$config.max_upload_size}</td>
            </tr>
            <tr>
                <td>CLTPHP版本</td>
                <td>{:config('version')}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@include('admin.common.foot')
<script>
    layui.use('table', function() {
        var table = layui.table;
    })
</script>
</body>
</html>