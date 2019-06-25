<!-- 页头 -->
{{ partial('layouts/content_header', {'_1title':'添加用户','_2title':'创建新用户'}) }}


<!-- 主内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default" style="padding: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title">请输入必要信息</h3>
                </div>

                <form class="form-horizontal" action="{{ url.get('admin/user/save') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputUser" class="col-sm-2 control-label">用户名（必填）</label>

                            <div class="col-sm-10">
                                <input
                                        type="text"
                                        name="inputUser"
                                        class="form-control"
                                        id="inputUser"
                                        placeholder="user name"
                                        autocomplete="on"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                    for="inputEmail"
                                    class="col-sm-2 control-label"
                            >
                                Email（必填）
                            </label>
                            <div class="col-sm-10">
                                <input
                                        type="email"
                                        name="inputEmail"
                                        class="form-control"
                                        id="inputEmail"
                                        placeholder="Email"
                                        autocomplete="on"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                    for="inputPassword"
                                    class="col-sm-2 control-label"
                            >
                                密码（必填）
                            </label>
                            <div class="col-sm-10">
                                <input
                                        type="password"
                                        name="inputPassword"
                                        class="form-control"
                                        id="inputPassword"
                                        placeholder="Password"
                                        autocomplete="on"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                    for="inputPassword2"
                                    class="col-sm-2 control-label"
                            >
                                密码确认
                            </label>

                            <div class="col-sm-10">
                                <input
                                        type="password"
                                        name="inputPassword2"
                                        class="form-control"
                                        id="inputPassword2"
                                        placeholder="Password"
                                        autocomplete="on"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                    for="inputSite"
                                    class="col-sm-2 control-label"
                            >
                                站点
                            </label>

                            <div class="col-sm-10">
                                <input
                                        type="text"
                                        name="inputSite"
                                        class="form-control"
                                        id="inputSite"
                                        placeholder="http://......"
                                        autocomplete="on"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">角色</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputRole" autocomplete="on">
                                    <option value="subscriber">订阅者</option>
                                    <option value="writer">作者</option>
                                    <option value="editor">编辑</option>
                                    <option value="administrator">管理员</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">确定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


